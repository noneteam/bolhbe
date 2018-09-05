<?php

namespace backend\controllers\company;

/**
 * Company default rest controller
 */
class PlaceController extends \common\components\RailsRest
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
				'defaultModel' => new \common\modules\company\models\CompanyPlace,
			],
			'view' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\modules\company\models\CompanyPlaceSearch,
			],
		], parent::actions());
	}
}
