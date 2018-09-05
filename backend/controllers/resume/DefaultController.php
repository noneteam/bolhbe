<?php

namespace backend\controllers\resume;

/**
 * Resume default rest controller
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
			'roles' => ['worker'],
		], [
			'allow' => true,
			'actions' => ['create'],
			'roles' => ['user'],
		], [
			'allow' => true,
			'actions' => ['update', 'delete'],
			'roles' => ['worker'],
		]];

		parent::__construct($id, $module, $config);
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'index' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\resume\models\ResumeSearch,
			],
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\resume\models\ResumeForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\models\Resume::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\models\ResumeForm::className(),
				'allowModels' => [
					'ResumeState' => \common\modules\resume\models\ResumeState::className(),
				],
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\models\ResumeDelete::className(),
			],
		], parent::actions());
	}
}
