<?php

namespace common\modules\resume\modules\university\models;

class LabelFacultySearch extends \yii\base\Model
{
	public  $text;

	/**
	 * @inheritdoc
	 */
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
		return LabelFaculty::find(['status_id' => LabelFaculty::STATUS_ACTIVE]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['LIKE', 'text', $this->text],
		];
	}
}