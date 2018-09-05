<?php

namespace common\modules\vacancy\modules\position\models;

/**
 * List of positions
 *
 * Class VacancyPositionSearch
 * @package common\modules\location\models
 */
class VacancyPositionSearch extends \yii\base\Model
{
	public $text;

	public function rules()
	{
		return [
			['text', 'string'],
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return VacancyPosition::find(['status_id' => VacancyPosition::STATUS_ACTIVE]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['like', 'text', $this->text]
		];
	}
}