<?php

namespace common\modules\resume\modules\experience\models;

use common\components\RelationHelper;
use common\components\validators\HtmlPrepareFilter;
use common\components\validators\ProtectValidator;

/**
 * Experience create/update form
 *
 * Class ResumeExperienceForm
 * @package common\modules\resume\modules\experience\models
 */
class ResumeExperienceForm extends ResumeExperience
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['hired', 'dismissed'], 'date', 'format' => 'php:Y-m'],

			['content', 'string', 'max' => '500'],
			['content', HtmlPrepareFilter::className()],

			[['position', 'place', 'region', 'scope', 'hired', 'content'], 'required'],

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
	public function setPosition($value)
	{
		$this->position_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setPlace($value)
	{
		$this->place_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setScope($value)
	{
		$this->scope_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setRegion($value)
	{
		$this->region_id = RelationHelper::setValue($value);
	}

	/**
	 * @param integer $value
	 */
	public function setHired($value)
	{
		$this->hired = $value;
		$this->hired_at = strtotime($value);
	}

	/**
	 * @param integer $value
	 */
	public function setDismissed($value)
	{
		$this->dismissed = $value;
		$this->dismissed_at = strtotime($value);
	}
}