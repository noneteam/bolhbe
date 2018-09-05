<?php

namespace frontend\controllers;

class ResumeController extends \yii\web\Controller
{
	public function actions()
	{
		return [
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\resume\models\ResumeSearch,
				'render' => true,
			],
		];
	}
}
