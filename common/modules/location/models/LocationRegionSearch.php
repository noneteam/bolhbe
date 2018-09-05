<?php

namespace common\modules\location\models;

/**
 * List of regions
 *
 * Class LocationRegionSearch
 * @package common\modules\location\models
 */
class LocationRegionSearch extends \yii\base\Model
{
	public $text;

	public function rules()
	{
		return [
			['text', 'string']
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return LocationRegion::find()
			->where([
				'status_id' => LocationRegion::STATUS_ACTIVE
			]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['like', 'text', $this->text],
		];
	}
}
