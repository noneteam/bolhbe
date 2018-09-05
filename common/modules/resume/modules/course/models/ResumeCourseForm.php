<?php

namespace common\modules\resume\modules\course\models;

use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * Course create/update form
 *
 * Class ResumeCourseForm
 * @package common\modules\resume\modules\course\models
 */
class ResumeCourseForm extends ResumeCourse
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'string', 'max' => '64'],
			['text', 'match', 'pattern' => self::PATTERN_RUSLATNUMSYM],

			[['text', 'certificate', 'company_place'], 'required'],

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
	public function setCertificate($value)
	{
		$this->certificate_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setCompany_place($value)
	{
		$this->company_place_id = RelationHelper::setValue($value);
	}
}