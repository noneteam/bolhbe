<?php

namespace common\behaviors;

use Yii;
use common\modules\resume\models\Resume;

class ResumeModuleBehavior extends \yii\base\Behavior
{
	public $module;

	public function events()
	{
		return [
			yii\db\ActiveRecord::EVENT_BEFORE_INSERT => function($event) {
				$this->owner->resume_id = Yii::$app->user->identity->resume->id;
			},
			yii\db\ActiveRecord::EVENT_AFTER_INSERT => function($event) {
				Yii::$app->user->identity->resume->count->up($this->module);

				Resume::updateAll(['updated_at' => time()], 'id = :id', [':id' => $this->owner->resume_id]);
			},
			yii\db\ActiveRecord::EVENT_AFTER_UPDATE => function($event) {
				if ($this->owner->status_id == ($this->owner)::STATUS_DELETED)
					Yii::$app->user->identity->resume->count->down($this->module);

				Resume::updateAll(['updated_at' => time()], 'id = :id', [':id' => $this->owner->resume_id]);
			},
		];
	}
}