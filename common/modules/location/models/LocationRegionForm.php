<?php

namespace common\modules\location\models;

use common\components\validators\TextPrepareFilter;

class LocationRegionForm extends LocationRegion
{
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

			['text', 'required'],
		];
	}
}