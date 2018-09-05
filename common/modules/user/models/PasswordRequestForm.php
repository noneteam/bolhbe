<?php

namespace common\modules\user\models;

use common\components\validators\ProtectValidator;

/**
 * Password reset request form
 *
 * @package common\modules\user\models
 */
class PasswordRequestForm extends \yii\base\Model
{
	public 	$phone,
			$protect;

	private $_user;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['phone', 'required'],

			['phone', 'exist',
				'targetClass' => new User,
				'filter' => ['!=', 'status_id', User::STATUS_DELETED],
			],

			['phone', 'match', 'pattern' => User::PATTERN_PHONE],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}],
		];
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		if (!$model->hasErrors() && $sync)
			new \common\models\MessageSms($model->phone);

		return !$model->hasErrors();
	}

	public function defaultAction()
	{
		$user = $this->getUser();

		if (!User::isPasswordResetTokenValid($user->password_reset_token))
			$user->generatePasswordResetToken();

		if ($user->save(false))
			return $user->password_reset_token;
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
