<?php

namespace common\modules\user\models;

use Yii;
use yii\web\ForbiddenHttpException;
use common\components\validators\ProtectValidator;

/**
 * Set  phone model
 *
 * @package common\modules\user\models
 */
class PhoneConnectForm extends User
{
	public $protect;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['phone', 'match', 'pattern' => User::PATTERN_PHONE],

			['phone', 'unique',
				'targetClass' => new parent,
				'filter' => ['!=', 'status_id', parent::STATUS_DELETED]
			],

			['phone', 'required'],

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
	 * @return boolean
	 */
	static function protectRequired($model, $sync=true)
	{
		if (!$model->hasErrors() && $sync)
			new \common\models\MessageSms($model->phone);

		return !$model->hasErrors();
	}

	/**
	 * Updates phone and removes 'facebookUser' role.
	 */
	public function defaultAction()
	{
		$role1 = Yii::$app->authManager->getRole('facebookUser');
		$role2 = Yii::$app->authManager->getRole('user');

		if (Yii::$app->user->can('facebookUser'))
			Yii::$app->authManager->revoke($role1, Yii::$app->user->id);

		if (!Yii::$app->user->can('user') && !empty($this->profile->region))
			Yii::$app->authManager->assign($role2, Yii::$app->user->id);

		return $this->updateAttributes(['phone' => $this->phone]);

	}

	public static function loadModel()
	{
		if (!Yii::$app->user->can('facebookUser'))
			throw new ForbiddenHttpException('Вы не можете выполнять данное действие.');

		return static::findIdentity(Yii::$app->user->id);
	}
}