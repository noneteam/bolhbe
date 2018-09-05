<?php

namespace common\modules\location\models;

/**
 * List of cities
 *
 * Class LocationCitySearch
 * @package common\modules\location\models
 */
class LocationCitySearch extends \yii\base\Model
{
	public $region;
	public $text;

	public function rules()
	{
		return [
			['text', 'string'],
			['region', 'integer'],
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return LocationCity::find()
			->where([
				'status_id' => LocationCity::STATUS_ACTIVE
			]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['like', 'text', $this->text],
			['=', 'region_id', $this->region],
		];
	}
}
