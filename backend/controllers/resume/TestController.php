<?php

namespace backend\controllers\resume;

/**
 * Resume test rest controller
 */
class TestController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\resume\modules\test\models\ResumeTestForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\modules\test\models\ResumeTest::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\test\models\ResumeTestForm::className(),
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\test\models\ResumeTestDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}