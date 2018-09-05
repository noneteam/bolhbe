<?php

namespace common\models;

/**
 * LabelScope model
 *
 * @property integer $id
 * @property string $text
 * @property integer $type_id
 * @property integer $status_id
 */
class LabelScope extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	
	const TYPE_VACANCY = 1;
	const TYPE_RESUME = 1;
	const TYPE_EXPERIENCE = 1;
	const TYPE_PROJECT = 2;

	/**
	 * @inheritdoc
	 */
	public function fields() {
		return [
			'text',
			'id',
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return self::find();
	}
}