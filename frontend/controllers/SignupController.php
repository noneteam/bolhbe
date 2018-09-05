<?php

namespace frontend\controllers;

use yii\web\Controller;

class SignupController extends Controller
{
	public function actionIndex()
	{
		return $this->render('@frontend/views/site/signup');
	}
}
