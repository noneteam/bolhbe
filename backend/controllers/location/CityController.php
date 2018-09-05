<?php

namespace backend\controllers\location;

/**
 * Location city rest controller
 */
class CityController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\location\models\LocationCityForm,
			],
			'view' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\location\models\LocationCitySearch,
			],
		], parent::actions());
	}
}
