<?php

namespace backend\controllers;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{
	public $layout = 'minimal';

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			],
			'doc' => [
				'class' => 'common\actions\RenderAction',
				'isBackend' => true
			],
		];
	}
}
