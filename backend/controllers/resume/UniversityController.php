<?php

namespace backend\controllers\resume;

/**
 * Resume university rest controller
 */
class UniversityController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->rules = [[
			'allow' => true,
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
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\resume\modules\university\models\ResumeUniversityForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\modules\university\models\ResumeUniversity::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\university\models\ResumeUniversityForm::className(),
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\university\models\ResumeUniversityDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}