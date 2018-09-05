<?php

namespace common\modules\resume\modules\university\models;

use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * University create/update form
 *
 * Class ResumeUniversityForm
 * @package common\modules\resume\modules\university\models
 */
class ResumeUniversityForm extends ResumeUniversity
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['level_id', 'in', 'range' => [5, 6, 7, 8, 9, 10, 11]],

			[['title', 'specialty', 'level', 'diploma', 'faculty'], 'required'],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	/**
	 * @param array $value
	 */
	public function setTitle($value)
	{
		$this->title_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setFaculty($value)
	{
		$this->faculty_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setSpecialty($value)
	{
		$this->specialty_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setDiploma($value)
	{
		$this->diploma_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setLevel($value)
	{
		$this->level_id = RelationHelper::setValue($value);
	}
}