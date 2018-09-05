<?php

namespace common\components\validators;

/**
 * Class TextUpFilter
 * @package common\components\validators
 */
class TextPrepareFilter extends \yii\validators\Validator
{
	public $isWords = false;

	/**
	 * @param $value
	 * @return mixed|string converted to normal string
	 */
	public function validateAttribute($model, $attribute) 
	{
		$value = trim($model->$attribute);

		$value = preg_replace('/\s{2,}/', ' ', $value);
		$value = preg_replace('/-{2,}/', '-', $value);

		$value = preg_replace('/ - /', '-', $value);

		if ($this->isWords)
			$vaule = mb_convert_case($value, MB_CASE_TITLE, 'UTF-8');

		if (mb_check_encoding($value, 'UTF-8')) {

			$value = mb_substr(mb_strtoupper($value, "utf-8"), 0, 1, 'utf-8')
					.mb_substr(mb_strtolower($value, "utf-8"), 1, mb_strlen($value), 'utf-8');
		}

		$model->$attribute = $value; 
	}
}