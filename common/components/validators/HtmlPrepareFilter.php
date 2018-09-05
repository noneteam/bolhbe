<?php

namespace common\components\validators;

/**
 * Class TextUpFilter
 * @package common\components\validators
 */
class HtmlPrepareFilter extends \yii\validators\Validator
{
	public $tags = '<p><b><strong><i><em><u><s><del><ul><ol><li><img><a>';

	/**
	 * @param $value
	 * @return mixed|string converted to normal string
	 */
	public function validateAttribute($model, $attribute) 
	{
		$output = strip_tags($model->$attribute, $this->tags);
		$output = preg_replace('/(<[^>]+) style=("|\').*?("|\')/i', '$1', $output);

		$model->$attribute = $output;
	}
}