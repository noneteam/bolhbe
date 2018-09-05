<?php

namespace common\modules\user\models;

use common\components\validators\TextPrepareFilter;

/**
 * Signup full form
 *
 * @package common\modules\user\models
 */
class SignupFormExtra extends SignupForm
{
	public 	$name,
			$family,
			$role;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array_merge([
			[['name', 'family', 'role', 'password'], 'required'],

			[['name', 'family'], 'match', 'pattern' => UserProfile::PATTERN_RUS],
			[['name', 'family'], 'string', 'min' => 2, 'max' => 32],
			[['name', 'family'], TextPrepareFilter::className()],

			['role', 'in', 'range' => ['worker', 'employer']],
		], parent::rules());
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		$this->profile->setAttributes([
			'name' => $this->name,
			'family' => $this->family,
		], false);

		/**
		 * Calling profile save action
		 * @return SignupForm::afterSave
		 */
		parent::afterSave($insert, $changedAttributes);
	}
}
