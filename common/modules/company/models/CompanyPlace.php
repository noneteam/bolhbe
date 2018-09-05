<?php

namespace common\modules\company\models;

/**
 * 
 * This is the model class for table "company_place".
 *
 * @property integer $id
 * @property string $text
 * @property integer $type_id
 * @property integer $status_id
 * 
 * @package common\modules\company\models
 */
class CompanyPlace extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const TYPE_UNIVERSITY = 1;
	const TYPE_COMPANY = 3;

	const PATTERN_RUSLATSYM = '/^[а-яА-ЯёЁa-zA-Z\-\ \.\(\)\"]+$/u';

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'string', 'min' => '4', 'max' => '64'],
			['text', 'match', 'pattern' => self::PATTERN_RUSLATSYM],
			['text', 'filter', 'filter' => 'trim'],
			['text', 'unique'],

			['type_id', 'default', 'value' => self::TYPE_COMPANY],
			['type_id', 'in', 'range' => [self::TYPE_UNIVERSITY, self::TYPE_COMPANY]],

			['text', 'required'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'text',
			'id',
		];
	}
}