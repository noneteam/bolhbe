<?php

namespace common\components;

/**
 * Templates render controller
 */
class RailsTemplate extends \yii\web\Controller
{
	public $actions = ['list', 'view', 'form'];

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		foreach ($this->actions as $key)
			$this->actions[$key]['class'] = 'common\actions\RenderAction';

		return $this->actions;
	}
}