<?php

namespace common\actions;

use Yii;

class RenderAction extends \yii\base\Action
{
	public $isBackend = false;

	public function run()
	{
		$view = Yii::$app->controller;

		if ($this->isBackend)
			return $view->render($view->action->id);

		return $view->renderAjax("@app/assets/spa/{$view->action->controller->id}/{$view->action->id}");
	}
}
