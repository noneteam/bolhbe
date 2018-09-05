<?php

namespace common\modules\vacancy\modules\position\models;

use Yii;

/**
 * This is the model class for table "vacancy_position".
 *
 * @property integer $id
 * @property string $text
 * @property integer $status_id
 */
class VacancyPosition extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const PATTERN_RUSLAT = '/^[а-яА-ЯёЁa-zA-Z\-\ ]+$/u';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%vacancy_position}}';
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