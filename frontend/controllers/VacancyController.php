<?php

namespace frontend\controllers;

use yii\web\NotFoundHttpException;
use common\modules\vacancy\models\Vacancy;

class VacancyController extends \yii\web\Controller
{
	public function actions()
	{
		return [
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\vacancy\models\VacancySearch,
				'render' => true,
			],
			/*'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\vacancy\models\Vacancy::className(),
				'render' => true,
			],*/
		];
	}

	public function actionView($id)
	{
		if (!$model = Vacancy::findOne($id))
			throw new NotFoundHttpException('Вакансия с таким ID не найдена.');

		if ($model->status_id == Vacancy::STATUS_DELETED)
			throw new NotFoundHttpException('Вакансия удалена автором.');

		if ($model->status_id != Vacancy::STATUS_ACTIVE)
			$model->phone = '9*********';

		return $this->render('view', [
			'model' => $model
		]);
	}
}
