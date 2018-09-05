<?php

namespace common\modules\user\models;

/**
 * This is the model class for table "auth_assignment".
 *
 * @property string $item_name
 * @property integer $user_id
 * @property integer $created_at
 */
class AuthAssignment extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function fields() {
		return [
			'item_name'
		];
	}
}