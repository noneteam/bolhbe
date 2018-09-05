<?php

namespace backend\controllers\resume;

/**
 * Resume default rest controller
 */
class FacultyController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->except = array_merge([
			'view',
			'create',
		], $this->except);

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
				'defaultModel' => new \common\modules\resume\modules\university\models\LabelFacultyForm,
			],
			'view' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\resume\modules\university\models\LabelFacultySearch,
			],
		], parent::actions());
	}
}
