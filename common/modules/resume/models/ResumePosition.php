<?php

namespace common\modules\resume\models;

class ResumePosition extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return ['position'];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosition()
	{
		return $this->hasOne(\common\modules\vacancy\modules\position\models\VacancyPosition::className(), ['id' => 'position_id']);
	}

	/**
	 * Sync (remove old, push new) positions by data from form
	 */
	public static function sync($id, $positions = [])
	{
		self::deleteAll(['resume_id' => $id]);

		foreach($positions as $value) {
			$model = new self;

			$model->resume_id = $id;
			$model->position_id = $value['position']['id'];

			$model->save(false);
		}
	}
}