<?php

namespace frontend\controllers;

class UserController extends \yii\web\Controller
{
	public function actions()
	{
		return [
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\user\models\UserView::className(),
				'render' => true
			],
		];
	}
}
