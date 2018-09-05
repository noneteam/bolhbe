<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Компании';

$titleTag = Html::tag('h2', $this->title, ['itemprop' => 'name']);

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