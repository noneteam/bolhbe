<?php

namespace common\modules\vacancy\modules\position\models;

use Yii;
use common\components\validators\TextPrepareFilter;

class VacancyPositionForm extends VacancyPosition
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'unique'],
			['text', 'string', 'min' => '4', 'max' => '64'],
			['text', 'match', 'pattern' => parent::PATTERN_RUSLAT],
			['text', TextPrepareFilter::className()],
			['text', 'required'],
		];
	}
}