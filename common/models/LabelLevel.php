<?php

namespace common\models;

/**
 * LabelLevel model
 *
 * @property integer $id
 * @property string $text
 * @property integer $type_id
 * @property integer $status_id
 */
class LabelLevel extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;
	
	const TYPE_LANGUAGE = 1;
	const TYPE_UNIVERSITY = 2;

	public $type;

	public function rules()
	{
		return [
			['type', 'integer']
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

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return self::find();
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['=', 'type_id', $this->type],
		];
	}
}