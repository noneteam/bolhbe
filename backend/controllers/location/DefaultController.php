<?php

namespace backend\controllers\location;

/**
 * Company default rest controller
 */
class DefaultController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->except = array_merge([
			'index',
		], $this->except);

		parent::__construct($id, $module, $config);
	}

	public function actionIndex()
	{
		$geo = new \common\modules\location\models\LocationGeo;

		$output = [];

		if ($location = $geo->getByIp()) {

			if (isset($location['region']))
				$output['region'] = \common\modules\location\models\LocationRegion::find()
					->where(['like', 'text', $location['region']])
					->one();

			if (isset($location['city']))
				$output['city'] = \common\modules\location\models\LocationCity::find()
					->where(['like', 'text', $location['city']])
					->one();

		}

		return $output;

	}
}
