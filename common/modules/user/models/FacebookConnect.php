<?php

namespace common\modules\user\models;

use yii\helpers\ArrayHelper;

/**
 * Facebook profile conect form
 */
class FacebookConnect extends User
{
	public $facebookcom;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return ArrayHelper::merge([
			['facebook_hash', 'required'],
			['facebook_hash', 'unique'],
		], parent::rules());
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		$this->profile->updateAttributes([
			'facebookcom' => $this->facebook_hash
		]);

		parent::afterSave($insert, $changedAttributes);
	}
}


