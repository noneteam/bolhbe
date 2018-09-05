<?php

namespace common\components;

/**
 * @package common\components
 */
class RelationHelper
{
	/**
	 * @param $value
	 * @return bool
	 */
	public static function setValue($value)
	{
		if (is_array($value) && isset($value['id']))
			return $value['id'];
	}

	/**
	 * @param $value
	 * @return bool
	 */
	public static function setValues($value, $field)
	{
		$array = [];

		if (is_array($value))
			foreach($value as $key => $value)
				if (isset($value['id']))
					$array[$key][$field] = $value;

		return $array;
	}
}