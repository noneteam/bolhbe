<?php

namespace frontend\controllers\spa;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
		];
	}
}
