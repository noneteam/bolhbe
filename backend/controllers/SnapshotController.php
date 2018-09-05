<?php

namespace backend\controllers;

class SnapshotController extends \yii\web\Controller
{
	public $layout = 'minimal';

	public function actionVacancy()
	{
		return $this->render('vacancy');
	}
}