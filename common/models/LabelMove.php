<?php

namespace common\models;

/**
 * LabelMove model
 *
 * @property integer $id
 * @property string $text
 * @property integer $status_id
 */
class LabelMove extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
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