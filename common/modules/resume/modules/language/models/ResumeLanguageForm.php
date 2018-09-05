<?php

namespace common\modules\resume\modules\language\models;

use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * Language create/update form
 *
 * Class ResumeLanguageForm
 * @package common\modules\resume\modules\language\models
 */
class ResumeLanguageForm extends ResumeLanguage
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['level_id', 'in', 'range' => [1, 2, 3, 4]],

			['language', 'validatorLanguageExists'],

			[['language', 'level'], 'required'],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	public function validatorLanguageExists($attribute, $params)
	{
		if ($this->isNewRecord && self::findOne([
				'resume_id' => $this->resume_id,
				'language_id' => $this->language_id,
				'status_id' => self::STATUS_ACTIVE]))
			$this->addError($attribute, 'Этот язык добавлен ранее.');
	}

	/**
	 * @param array $value
	 */
	public function setLanguage($value)
	{
		$this->language_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setLevel($value)
	{
		$this->level_id = RelationHelper::setValue($value);
	}
}