<?php

namespace common\modules\response\models;

use common\components\RelationHelper;

/**
 * Vacancy response model
 *
 * Class ResponseVacancyForm
 * @package common\modules\response\models
 */
class ResponseCreate extends Response
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\behaviors\BlameableBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array_merge([
			[['resume', 'vacancy'], 'required'],
		], parent::rules());
	}

	/**
	 * @param array $value
	 */
	public function setResume($value)
	{
		$this->resume_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setVacancy($value)
	{
		$this->vacancy_id = RelationHelper::setValue($value);
	}
}