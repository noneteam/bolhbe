<?php

namespace common\modules\resume\modules\university\models;

/**
 * Faculty create form
 */
class LabelFacultyForm extends LabelFaculty
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'required'],
			['text', 'string', 'max' => '64'],
			['text', 'match', 'pattern' => self::PATTERN_RUS],
			['text', 'unique'],
			['text', 'filter', 'filter' => 'trim'],
		];
	}
}