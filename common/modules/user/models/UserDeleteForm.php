<?php

namespace common\modules\user\models;

use Yii;
use common\components\validators\ProtectValidator;
use common\modules\vacancy\models\Vacancy;

/**
* User delete form
*
* @package common\modules\user\models
*/
class UserDeleteForm extends User
{
	public $protect;

	/**
	* @inheritdoc
	*/
	public function rules()
	{
		return [
			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}]
		];
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		new \common\models\MessageSms(Yii::$app->user->identity->phone);

		return true;
	}

	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		Vacancy::updateAll([
			'status_id' => Vacancy::STATUS_DELETED
		], [
			'user_id' => $this->id
		]);

		return $this->updateAttributes([
			'status_id' => parent::STATUS_DELETED,
		]);
	}

	public static function loadModel()
	{
		return static::findIdentity(Yii::$app->user->id);
	}
}
