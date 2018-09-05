<?php

namespace common\modules\location\models;

use common\components\RelationHelper;
use common\components\validators\TextPrepareFilter;

class LocationCityForm extends LocationCity
{
	public $region_id = 1;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'unique'],
			['text', 'string', 'max' => '64'],
			['text', 'match', 'pattern' => self::PATTERN_RUS],
			['text', TextPrepareFilter::className()],

			['region', 'safe'],

			['text', 'required'],
		];
	}

	/**
	 * @param array $value
	 */
	public function setRegion($value)
	{
		$this->region_id = RelationHelper::setValue($value);
	}
}