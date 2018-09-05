<?php

namespace common\actions;

use Yii;

class ViewAction extends \yii\base\Action
{
	public $defaultModel;

	public $render = false;

	public function run($id)
	{
		$model = $this->defaultModel;

		if ($this->render) {

			$view = Yii::$app->controller;

			return $view->render($view->action->id, [
				'model' => $model::loadModel($id)
			]);

		}

		return $model::loadModel($id);
	}
}