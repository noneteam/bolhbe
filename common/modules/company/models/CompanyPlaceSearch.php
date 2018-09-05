<?php

namespace common\modules\company\models;

/**
 * @package common\modules\company\models
 */
class CompanyPlaceSearch extends \yii\base\Model
{
	public 	$text,
			$type;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'string'],
			['type', 'integer'],
		];
	}

	public function querySearch()
	{
		return CompanyPlace::find(['status_id' => CompanyPlace::STATUS_ACTIVE]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['LIKE', 'text', $this->text],
			['=', 'type', $this->type],
		];
	}
}