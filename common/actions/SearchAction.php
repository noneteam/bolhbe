<?php

namespace common\actions;

use Yii;
use yii\helpers\ArrayHelper;

class SearchAction extends \yii\base\Action
{
	public 	$defaultModel,
			$pageSize = 25,
			$sort = SORT_DESC,
			$render = false;

	private function getQuery()
	{
		$model = $this->defaultModel;

		$model->load(Yii::$app->request->getQueryParams(), '');

		if (!method_exists($model, 'queryFilter') || !$model->validate())
			return $model->querySearch();

		$filters = $model->queryFilter();

		$model = $model->querySearch();

		foreach ($filters as $filter)
			$model->andFilterWhere($filter);

		return $model;
	}

	/**
	 * @return mixed
	 * @throws HttpException
	 */
	public function run()
	{
		$provider = new \yii\data\ActiveDataProvider([
			'query' => $this->getQuery(),
			'sort' => [
				'defaultOrder' => [
					'id' => $this->sort
				]
			],
			'pagination' => [
				'pageSize' => $this->pageSize,
				'pageSizeParam' => false
			]
		]);

		$data = [
			'items' => $provider->getModels(),
			'pagination' => [
				'totalCount' => $provider->pagination->totalCount,
				'defaultPageSize' => $provider->pagination->pageSize,
				'currentPage' => $provider->pagination->page + 1,
			]
		];

		if (method_exists($this->defaultModel, 'configureFilters'))
			foreach($this->defaultModel->configureFilters() as $filter => $conf) 
				$data['filters'][$filter] = $this->fillFilters($filter, $conf);

		if ($this->render) {

			$view = Yii::$app->controller;

			return $view->render($view->action->id, [
				'data' => $provider
			]);

		}

		return $data;
	}

	private function fillFilters($filter, $configure)
	{
		$relative = isset($configure['relative']) ? $configure['relative'] : null;

		$prefix = isset($configure['prefix'])? $configure['prefix'] : null;

		$filterQuery = $this->getQuery()->groupBy("$prefix$relative{$filter}_id");

		$data = [];

		foreach ($filterQuery->each() as $i => $one) {
			$data[$i]['id'] = ArrayHelper::getValue($one,  "$relative$filter.id");
			$data[$i]['text'] = ArrayHelper::getValue($one, "$relative$filter.text");
		}

		return $data;
	}
}