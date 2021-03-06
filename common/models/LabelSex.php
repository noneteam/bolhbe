<?php

namespace common\models;

/**
 * LabelSex model
 *
 * @property integer $id
 * @property string $text
 * @property integer $status_id
 */
class LabelSex extends \yii\db\ActiveRecord
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