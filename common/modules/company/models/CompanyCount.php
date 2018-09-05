<?php

namespace common\modules\company\models;

/**
 * This is the model class for table "company_count".
 *
 * @property integer $id
 * @property integer $view
 * @property integer $vacancy
 * @property integer $project
 */
class CompanyCount extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'view',
			'vacancy',
			'project'
		];
	}

	public function up($type, $model)
	{
		if (!$model->company_place_id || (
				$model->old_company_place_id &&
				$model->old_company_place_id != null &&
				$model->company_place_id == $model->user->company->title_id
			)
		)
			$this->updateAttributes([$type => $this->$type + 1]);
	}

	public function down($type, $model)
	{
		if (!$model->company_place_id || (
				$model->old_company_place_id &&
				$model->old_company_place_id == null &&
				$model->company_place_id != $model->user->company->title_id
			)
		)
			$this->updateAttributes([$type => $this->$type - 1]);
	}
}