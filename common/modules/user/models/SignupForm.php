<?php

namespace common\modules\user\models;

use Yii;
use common\components\validators\ProtectValidator;

/**
 * Signup form
 * 
 * @package common\modules\user\models
 */
class SignupForm extends User
{
	public $protect;
	public $password;
	public $profile;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['phone', 'required'],

			['phone', 'match', 'pattern' => parent::PATTERN_PHONE],

			['phone', 'unique',
				'targetClass' => new parent,
				'filter' => ['!=', 'status_id', parent::STATUS_DELETED]
			],

			['password', 'string', 'min' => 5],

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
		if (($condition = !$model->hasErrors()) && $sync)
			new \common\models\MessageSms($model->phone);

		return $condition;
	}

	/**
	 * Extra save() action
	 */
	public function defaultAction($login = true)
	{
		$this->setPassword($this->password ?: $this->protect);
		$this->generateAuthKey();

		$this->profile = new UserProfile;

		if ($this->save() && $login && Yii::$app->getUser()->login($this))
			return Yii::$app->user->identity->getAuthKey();
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		$this->profile->id = $this->id;
		$this->profile->save(false);

		parent::afterSave($insert, $changedAttributes);
	}
}
