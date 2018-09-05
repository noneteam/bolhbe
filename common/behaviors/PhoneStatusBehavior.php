<?php

namespace common\behaviors;

use Yii;
use common\modules\user\models\User;

class PhoneStatusBehavior extends \yii\base\Behavior
{
	public function events()
	{
		return [
			yii\db\ActiveRecord::EVENT_AFTER_INSERT => 'updateStatus',
			yii\db\ActiveRecord::EVENT_AFTER_UPDATE => 'updateStatus',
		];
	}

	public function updateStatus($event)
	{
		if (Yii::$app->user->identity->status_id == User::STATUS_PHONE)
			Yii::$app->user->identity->updateAttributes(['status_id' => User::STATUS_ACTIVE]);
	}
}