<?php

namespace common\modules\user\models;

use Yii;
use yii\web\ForbiddenHttpException;
use common\components\validators\ProtectValidator;

/**
* User phone update form
*
* @package common\modules\user\models
*/
class PhoneUpdateForm extends User
{
	public $protect;

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
			['phone', 'required'],

			['phone', 'match', 'pattern' => parent::PATTERN_PHONE],

			['phone', function($model) {
				if ($this->phone === Yii::$app->user->identity->phone)
					return $this->addError($model, 'Необходимо заполнить «Телефон».');
			}],

			['phone', 'unique',
				'targetClass' => new parent,
				'filter' => ['!=', 'status_id', parent::STATUS_DELETED]
			],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'phone' => function() {
				return $this->getPhone();
			},
		];
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model)
	{
		if (!$model->hasErrors('phone'))
			new \common\models\MessageSms($model->phone);

		return !$model->hasErrors('phone');
	}

	public static function loadModel()
	{
		if (Yii::$app->user->can('facebookUser'))
			throw new ForbiddenHttpException('Вы не можете выполнять данное действие.');

		return static::findIdentity(Yii::$app->user->id);
	}
}
