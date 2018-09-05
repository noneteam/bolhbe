<?php

namespace common\modules\location\models;

class LocationRegion extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	
	const PATTERN_RUS = '/^[а-яА-ЯёЁ\-\ ]+$/u';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%location_region}}';
	}

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
}