<?php

namespace backend\controllers\vacancy;

/**
 * Vacancy position rest controller
 */
class PositionController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\vacancy\modules\position\models\VacancyPositionForm,
			],
			'view' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\vacancy\modules\position\models\VacancyPositionSearch,
			],
		], parent::actions());
	}
}







