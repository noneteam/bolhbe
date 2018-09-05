<?php

namespace common\modules\resume\modules\test\models;

use Yii;
use common\components\validators\ProtectValidator;

/**
 * Test delete form
 *
 * Class ResumeTestDelete
 * @package common\modules\resume\models
 */
class ResumeTestDelete extends ResumeTest
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
			Yii::$app->user->identity->resume->count->down('test');
	}
}