<?php

namespace common\modules\user\models;

use Yii;
use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * User phone availability set form
 *
 * @package common\modules\user\models
 */
class PhoneAvailabilitySet extends User
{
	public $protect;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['show_phone', 'required'],

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
		$phoneNotProtected = Yii::$app->user->identity->status_id == parent::STATUS_PHONE;

		if (($condition = !$model->hasErrors() && $phoneNotProtected) && $sync)
			new \common\models\MessageSms(Yii::$app->user->identity->phone);

		return $condition;
	}

	public function fields()
	{
		return [
			'phone' => function() {
				return $this->getPhone();
			},
			'show_phone',
		];
	}

	/**
	 * @param array $value
	 */
	public function setShow_phone($value)
	{
		$this->show_phone_id = RelationHelper::setValue($value);
	}


	public static function loadModel()
	{
		return static::findIdentity(Yii::$app->user->id);
	}
}