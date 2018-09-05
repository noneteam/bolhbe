<?php

namespace common\modules\resume\modules\test\models;

use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * Test create/update form
 *
 * Class ResumeTestForm
 * @package common\modules\resume\modules\test\models
 */
class ResumeTestForm extends ResumeTest
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['text', 'string', 'max' => '64'],
			['text', 'match', 'pattern' => self::PATTERN_RUSLATNUMSYM],

			[['text', 'company_place'], 'required'],

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
	public function setCompany_place($value)
	{
		$this->company_place_id = RelationHelper::setValue($value);
	}
}