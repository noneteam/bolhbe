<?php

namespace common\modules\resume\models;

use Yii;
use common\components\validators\ProtectValidator;

/**
 * Resume delete form
 *
 * Class ResumeDelete
 * @package common\modules\resume\models
 */
class ResumeDelete extends Resume
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	/**
	 * Pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		$role = Yii::$app->authManager->getRole('worker');
		Yii::$app->authManager->revoke($role, Yii::$app->user->id);

		return $this->updateAttributes(['status_id' => parent::STATUS_DELETED]);
	}
}