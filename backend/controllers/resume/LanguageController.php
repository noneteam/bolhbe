<?php

namespace backend\controllers\resume;

/**
 * Resume language rest controller
 */
class LanguageController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\resume\modules\language\models\ResumeLanguageForm,
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\resume\modules\language\models\ResumeLanguage::className()
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\language\models\ResumeLanguageForm::className(),
				'checkParameter' => true,
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\resume\modules\language\models\ResumeLanguageDelete::className(),
				'checkParameter' => true,
			],
		], parent::actions());
	}
}