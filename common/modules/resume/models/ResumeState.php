<?php

namespace common\modules\resume\models;

use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * Resume state set
 *
 * Class ResumeState
 * @package common\modules\resume\models
 */
class ResumeState extends Resume
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['state', 'required'],

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
	public function setState($value)
	{
		$this->state_id = RelationHelper::setValue($value);
	}

	/**
	 * Main extra update action
	 * @return boolean
	 */
	public function defaultAction()
	{

		$this->updateAttributes(['state_id' => $this->state->id]);

		return [
			'state' => $this->state
		];

	}
}