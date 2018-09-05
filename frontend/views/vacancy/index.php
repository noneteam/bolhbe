<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Вакансии';

$request = \Yii::$app->request;
$region = '';

if (count($request->get()) == 1){
	if ($request->get('region')){

		if ($request->get('region') == 6)
			$region .= ' в Ингушетии';
		else if ($request->get('region') == 95)
			$region .= ' в Чеченской республике';

	}
}

$this->title .= $region;

$titleTag = Html::tag('h2', $this->title, ['itemprop' => 'name', 'title' => "Работа$region"]);

?>

<?= ListView::widget([
	'dataProvider' => $data,
	'itemView' => 'item',
	'options' => [
		'itemscope' => true,
		'itemtype' => 'http://schema.org/ItemList',
	],
	'itemOptions' => [
		'itemprop' => 'itemListElement'
	],
	'layout' => "\n$titleTag\n{summary}\n{items}\n{pager}"
]); ?>

<?= $this->render('@frontend/assets/spa/vacancy/list-sidebar-footer') ?>