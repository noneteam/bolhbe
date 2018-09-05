<?php

namespace common\modules\location\models;

/**
 * This is the model class for table "location_city".
 *
 * @property integer $id
 * @property string $text
 * @property integer $region_id
 *
 * @property LocationRegion $region
 */

class LocationCity extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	
	const PATTERN_RUS = '/^[а-яА-ЯёЁ\-\ ]+$/u';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%location_city}}';
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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRegion()
	{
		return $this->hasOne(LocationRegion::className(), ['id' => 'region_id']);
	}
}