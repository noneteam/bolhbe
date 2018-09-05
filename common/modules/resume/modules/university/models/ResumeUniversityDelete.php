<?php

namespace common\modules\resume\modules\university\models;

use Yii;
use common\components\validators\ProtectValidator;

/**
 * University delete form
 *
 * Class ResumeUniversityDelete
 * @package common\modules\resume\models
 */
class ResumeUniversityDelete extends ResumeUniversity
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
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		if ($this->updateAttributes(['status_id' => parent::STATUS_DELETED]))
			Yii::$app->user->identity->resume->count->down('university');
	}
}