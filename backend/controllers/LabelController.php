<?php

namespace backend\controllers;

/**
 * Label lists rest controller
 */
class LabelController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->except = array_keys($this->actions());

		parent::__construct($id, $module, $config);
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'certificate' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelCertificate,
				'sort' => SORT_ASC,
			],
			'diploma' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelDiploma,
				'sort' => SORT_ASC,
			],
			'employment' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelEmployment,
				'sort' => SORT_ASC,
			],
			'experience' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelExperience,
				'sort' => SORT_ASC,
			],
			'language' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelLanguage,
				'sort' => SORT_ASC,
				'pageSize' => 77,
			],
			'level' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelLevel,
				'sort' => SORT_ASC,
			],
			'move' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelMove,
				'sort' => SORT_ASC,
			],
			'scope' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelScope,
				'sort' => SORT_ASC,
				'pageSize' => 39
			],
			'sex' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelSex,
				'sort' => SORT_ASC,
			],
			'show-phone' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelShowPhone,
				'sort' => SORT_ASC,
			],
			'state' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelState,
				'sort' => SORT_ASC,
			],
			'time' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelTime,
				'sort' => SORT_ASC,
			],
			'trip' => [
				'class' => 'common\actions\SearchAction',
				'defaultModel' => new \common\models\LabelTrip,
				'sort' => SORT_ASC,
			],
		], parent::actions());
	}
}







