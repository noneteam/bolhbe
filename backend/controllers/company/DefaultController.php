<?php

namespace backend\controllers\company;

/**
 * Company default rest controller
 */
class DefaultController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->except = [
			'index',
			'options',
		];

		$this->rules = [[
			'allow' => false,
			'actions' => ['create'],
			'roles' => ['employer'],
		], [
			'allow' => true,
			'actions' => ['create'],
			'roles' => ['user'],
		], [
			'allow' => true,
			'actions' => ['update', 'delete'],
			'roles' => ['employer'],
		]];

		parent::__construct($id, $module, $config);
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\company\models\CompanyForm,
			],
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\company\models\CompanySearch,
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\company\models\CompanyForm::className(),
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\company\models\CompanyDelete::className(),
			],
		], parent::actions());
	}
}
