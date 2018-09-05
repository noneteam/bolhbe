<?php

namespace common\modules\user\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;

/**
 * Password reset form
 *
 * @package common\modules\user\models
 */
class PasswordResetForm extends \yii\base\Model
{
	public $password;

	/**
	 * @var \common\modules\user\models\User
	 */
	private $_user;


	/**
	 * Creates a form model given a token.
	 *
	 * @param  string                          $token
	 * @param  array                           $config name-value pairs that will be used to initialize the object properties
	 * @throws \yii\base\InvalidParamException if token is empty or not valid
	 */
	public function __construct($config = [])
	{
		$token = Yii::$app->request->headers->get('Token');

		if (empty($token) || !is_string($token))
			throw new ForbiddenHttpException('Password reset token cannot be blank.');

		if (!$this->_user = User::findByPasswordResetToken($token))
			throw new NotFoundHttpException('Wrong password reset token.');

		parent::__construct($config);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['password', 'required'],
			['password', 'string', 'min' => 5],
		];
	}

	/**
	 * Resets password.
	 *
	 * @return boolean if password was reset.
	 */
	public function resetPassword()
	{
		$this->_user->setPassword($this->password);
		$this->_user->removePasswordResetToken();

		/**
		 * Автоматическая авторизация на сайте
		 */
		if ($this->_user->save(false))
			return Yii::$app->user->login($this->_user);
	}
}
