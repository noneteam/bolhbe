<?php

namespace common\modules\resume\modules\language\models;

use Yii;
use common\components\validators\ProtectValidator;

/**
 * Language delete form
 *
 * Class ResumeLanguageDelete
 * @package common\modules\resume\models
 */
class ResumeLanguageDelete extends ResumeLanguage
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
			Yii::$app->user->identity->resume->count->down('language');
	}
}