<?php

namespace backend\controllers\vacancy;

/**
 * Vacancy default rest controller
 */
class DefaultController extends \common\components\RailsRest
{
	public $except = [
		'options',
		'index',
		'create',
		'view',
	];

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\vacancy\models\VacancyFormExtra,
			],
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\vacancy\models\VacancySearch,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\vacancy\models\Vacancy::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\vacancy\models\VacancyForm::className(),
				'allowModels' => [
					'VacancyShow' => \common\modules\vacancy\models\VacancyShow::className(),
					'VacancyHide' => \common\modules\vacancy\models\VacancyHide::className(),
					'VacancyProlong' => \common\modules\vacancy\models\VacancyProlong::className(),
				],
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\vacancy\models\VacancyDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}







