<?php

namespace common\modules\resume\modules\university\models;

/**
 * LabelFaculty model
 *
 * @property integer $id
 * @property string $text
 * @property integer $status_id
 */
class LabelFaculty extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const PATTERN_RUS = '/^[а-яА-ЯёЁ\-\ ]+$/u';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%label_faculty}}';
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