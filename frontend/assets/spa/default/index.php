<?php

use yii\helpers\Html;

$worker = Html::tag('span', 'соискателя', [
	'class' => 'wo list-container-link',
]);

$employer = Html::tag('span', 'работодателя', [
	'class' => 'em list-container-link',
]);

$freelancer = Html::tag('span', 'фрилансера', [
	'class' => 'fl list-container-link',
]);

$iconFb = Html::tag('i', null, [
	'class' => 'fa fa-facebook'
]);

$iconVk = Html::tag('i', null, [
	'class' => 'fa fa-vk'
]);

$iconUser = Html::tag('i', null, [
	'class' => 'fa fa-user-plus'
]);

?>
<div class="page-home full-page">

	<div class="container">

		<?= Html::tag('h1', 'Нашел & Пригласил & Работаем!') ?>

		<?= Html::tag('p', "Инструменты $worker, $employer, $freelancer помогающие объединяться.") ?>

		<?= Html::a("$iconUser Зарегистрируйся", null, [
			'ui-sref' => 'user>signup',
			'ui-sref-active' => 'active',
			'class' => 'btn btn-default btn-md btn-add-content prevented-link',
		]); ?>

		<?= Html::a($iconFb, 'https://fb.me/bolhbe', [
			'class' => 'btn',
			'target' => '_blank',
		]); ?>

		<?= Html::a($iconVk, 'https://vk.com/bolhbe', [
			'class' => 'btn',
			'target' => '_blank',
		]); ?>

	</div>

</div>