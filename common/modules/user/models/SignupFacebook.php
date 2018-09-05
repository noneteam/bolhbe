<?php

namespace common\modules\user\models;

use Yii;
use common\components\validators\TextPrepareFilter;

/**
 * Signup via facebook.com form
 *
 * @package common\modules\user\models
 */
class SignupFacebook extends SignupForm
{
	public 	$name,
			$family,
			$email;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'family'], 'match', 'pattern' => UserProfile::PATTERN_RUS],
			[['name', 'family'], 'string', 'min' => 2, 'max' => 32],
			[['name', 'family'], TextPrepareFilter::className()],

			['email', 'string', 'max' => 64],
			['email', 'email'],

			['facebook_hash', 'unique',
				'targetClass' => new parent,
				'filter' => ['!=', 'status_id', parent::STATUS_DELETED]
			],

			['facebook_hash', 'match', 'pattern' => UserProfile::PATTERN_FACEBOOKCOM],

			[['facebook_hash'], 'required'],
		];
	}

	/**
	 * Extra save() action
	 */
	public function defaultAction()
	{
		$this->setPassword(rand(89999, 99999));
		$this->generateAuthKey();

		$this->profile = new UserProfile;

		return $this->save(false);
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		$this->profile->setAttributes([
			'name' => $this->name,
			'family' => $this->family,
			'email' => $this->email,
			'facebookcom' => $this->facebook_hash
		], false);

		/**
		 * Calling profile save action
		 * @return SignupForm::afterSave
		 */
		parent::afterSave($insert, $changedAttributes);

		$role = Yii::$app->authManager->getRole('facebookUser');
		Yii::$app->authManager->assign($role, $this->id);
	}
}
