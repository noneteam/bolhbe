<?php

namespace common\modules\user\models;

use Yii;
use common\components\validators\PasswordValidator;

/**
 * Login form
 */
class LoginForm extends \yii\base\Model
{
	public 	$phone,
			$password,
			$rememberMe = true;

	private $_user;


	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['rememberMe', 'boolean'],

			['phone', 'match', 'pattern' => User::PATTERN_PHONE],

			['password', 'string', 'min' => 5],

			[['phone', 'password'], 'required'],

			['password', 'returnValidator', 'when' => function($model) {
				return !$model->hasErrors();
			}],
		];
	}

	public function attributeLabels()
	{
		return [
			'phone' => 'номер телефона',
			'password' => 'пароль',
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function returnValidator($attribute, $params)
	{
		$validation = new PasswordValidator();
		$validation->user = $this->user;

		return $validation->validateAttribute($this, $attribute);
	}

	/**
	 * Logs in a user using the provided phone and password.
	 *
	 * @return bool whether the user is logged in successfully
	 */
	public function defaultAction()
	{
		$user = $this->getUser();

		/**
		 * Зачистка устаревшей md5 шифровки пароля
		 */
		if ($user->password_md5) {
			$user->setPassword($this->password);
			$user->password_md5 = null;
			$user->update();
		}

		if (Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0))
			return Yii::$app->user->identity->getAuthKey();
	}

	/**
	 * Finds user by [[phone]]
	 *
	 * @return User|null
	 */
	protected function getUser()
	{
		if ($this->_user === null)
			$this->_user = User::findByPhone($this->phone);

		return $this->_user;
	}
}
