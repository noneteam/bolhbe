<?php

namespace common\modules\user\models;

use Yii;

/**
 * Facebook login action
 *
 * @package common\modules\user\models
 */
class LoginFacebook extends \yii\base\Model
{
	private $_user;

	public $facebook_hash;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['facebook_hash', 'required'],

			['facebook_hash', 'unique',
				'targetClass' => new User,
				'filter' => ['!=', 'status_id', User::STATUS_DELETED]
			],
		];
	}

	/**
	 * Extra login() action based on facebook id
	 * @return auth_key|null
	 */
	public function getAuthKey()
	{
		if ($this->getUser() && Yii::$app->user->login($this->_user, 3600 * 24 * 30))
			return Yii::$app->user->identity->getAuthKey();
	}

	/**
	 * Finds user by [[facebook_hash]]
	 *
	 * @return User|null
	 */
	protected function getUser()
	{
		if ($this->_user === null)
			$this->_user = User::findByFacebookHash($this->facebook_hash);

		return $this->_user;
	}
}
