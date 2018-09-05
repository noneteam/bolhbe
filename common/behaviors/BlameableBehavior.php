<?php

namespace common\behaviors;

use Yii;

class BlameableBehavior extends \yii\base\Behavior
{
	public function events()
	{
		return [
			yii\db\ActiveRecord::EVENT_BEFORE_INSERT => function($event) {
				$this->owner->user_id = Yii::$app->user->identity->id;
			}
		];
	}
}