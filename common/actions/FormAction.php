<?php

namespace common\actions;

use Yii;

class FormAction extends \yii\base\Action
{
	public $defaultModel;

	public $allowModels = [];

	public $checkParameter = false;

	public function run($id=null)
	{
		$model = $this->loadModel($id);

		$model->load(Yii::$app->request->post(), '');

		if ($model->validate()) {

			if (method_exists($model, 'defaultAction')) return $model->defaultAction();

			if ($model->isNewRecord) 	$model->save(false);
			else 						$model->update(false);

		}

		return $model;
	}

	private function loadModel($id=null)
	{
		if (!$id && $this->checkParameter)
			throw new \yii\web\BadRequestHttpException('Отсутствуют обязательные параметры: id');

		$defaultModel = $this->defaultModel;

		$anotherModel = Yii::$app->request->headers->get('Set-Model');

		if (isset($anotherModel) && array_key_exists($anotherModel, $this->allowModels))
			$defaultModel = $this->allowModels[$anotherModel];

		if (!isset($defaultModel->isNewRecord))
			if (method_exists($defaultModel, 'loadModel'))
				return $defaultModel::loadModel($id);

		return $defaultModel;
	}
}