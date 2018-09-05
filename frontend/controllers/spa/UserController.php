<?php

namespace frontend\controllers\spa;

/**
 * User templates controller
 */
class UserController extends \common\components\RailsTemplate
{
	public $actions = [
		'view',
		'menu',
		'form-login',
		'form-login-request',
		'form-login-reset',
		'form-signup',
		'form-signup-fast',
		'form-phone',
		'form-password',
		'form',
	];

	public function actionSuccessGate($token)
	{
		$this->layout = '@backend/views/layouts/minimal';

		$this->view->registerJs("
			localStorage.setItem('access_token', '$token');
			window.close();");

		return $this->render('@app/assets/spa/user/empty');
	}

	public function actionSuccessConnect($client, $token)
	{
		$this->layout = '@backend/views/layouts/minimal';

		$this->view->registerJs("
			localStorage.setItem('$client', '$token');
			window.close();");

		return $this->render('@app/assets/spa/user/empty');
	}
}
