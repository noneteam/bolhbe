<?php

namespace backend\controllers\resume;

/**
 * Resume course rest controller
 */
class CourseController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\resume\modules\course\models\ResumeCourseForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\modules\course\models\ResumeCourse::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\course\models\ResumeCourseForm::className(),
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\course\models\ResumeCourseDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}