<?php

namespace backend\controllers\resume;

/**
 * Resume experience rest controller
 */
class ExperienceController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\resume\modules\experience\models\ResumeExperienceForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\modules\experience\models\ResumeExperience::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\experience\models\ResumeExperienceForm::className(),
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\experience\models\ResumeExperienceDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}