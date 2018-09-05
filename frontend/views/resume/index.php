<?php

use yii\helpers\Html;
use yii\widgets\ListView;

$this->title = 'Резюме';

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

<?= $this->render('@frontend/assets/spa/resume/list-sidebar-footer') ?>