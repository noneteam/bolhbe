<?php

namespace frontend\controllers;

class CompanyController extends \yii\web\Controller
{
	public function actions()
	{
		return [
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\company\models\CompanySearch,
				'render' => true,
			],
		];
	}
}
