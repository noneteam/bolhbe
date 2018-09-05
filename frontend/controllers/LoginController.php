<?php

namespace frontend\controllers;

use yii\web\Controller;

class LoginController extends Controller
{
	public function actionIndex()
	{
		return $this->render('@frontend/views/site/login');
	}
}
