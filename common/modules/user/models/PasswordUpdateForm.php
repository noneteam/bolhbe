<?php

namespace common\modules\user\models;

use Yii;
use common\components\validators\ProtectValidator;
use common\components\validators\PasswordValidator;

/**
 * Password update form
 *
 * @package common\modules\user\models
 */
class PasswordUpdateForm extends User
{
	public 	$protect,
			$password,
			$password_new;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\common\behaviors\PhoneStatusBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['password', 'password_new'], 'required'],
			[['password', 'password_new'], 'string', 'min' => 5],

			['password', 'ReturnValidator', 'when' => function($model) {
				return !$model->hasErrors();
			}],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}],
		];
	}

	/**
	 * Validates the password.
	 * This method serves as the inline validation for password.
	 *
	 * @param string $attribute the attribute currently being validated
	 * @param array $params the additional name-value pairs given in the rule
	 */
	public function ReturnValidator($attribute, $params)
	{
		$validation = new PasswordValidator();
		$validation->user = Yii::$app->user->identity;
		$validation->message = 'Не верно указан «текущий пароль».';

		return $validation->validateAttribute($this, $attribute);
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		$phoneNotProtected = Yii::$app->user->identity->status_id == parent::STATUS_PHONE;

		if (($condition = !$model->hasErrors() && $phoneNotProtected) && $sync)
			new \common\models\MessageSms(Yii::$app->user->identity->phone);

		return $condition;
	}

	/**
	 * @inheritdoc
	 */
	public function beforeSave($insert)
	{
		$this->setPassword($this->password_new);

		return parent::beforeSave($insert);
	}

	public static function loadModel()
	{
		return static::findIdentity(Yii::$app->user->id);
	}
}