<?php

use yii\helpers\Html;

$linkResumeSettings = Html::button($edit, [
	'ui-sref' => 'resume>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link pull-right btn-link',
]);

?>

<div class="row break">

	<ul class="col-sm-4 col-md-3 col-phone">
		<li>
			<?= Html::tag('i', null, ['class' => 'fa fa-volume-control-phone']) ?>
			<?= Html::a('{{content.phone|phone}}', 'tel: +7{{content.phone}}', [
				'title' => '{{content.show_phone.text}}'
			]) ?>
		</li>
	</ul>

	<ul class="col-sm-266 col-md-3 col-skills">
		<li>
			<?= Html::tag('label', 'Образование:') ?>
			<?= Html::tag('span', '{{item.level.text}}', [
				'ng-repeat' => "item in content.resume.university | orderBy:'-level.id' | limitTo:1"
			]) ?>
		</li>
		<li>
			<?= Html::tag('label', 'Опыт работы:') ?>
			<?= Html::tag('span', "{{(content.resume.count.seniority.years | integerToReadable: [' год', ' года', ' лет']) || 'Нет'}}", [
				'title' => "{{content.resume.count.seniority.years | integerToReadable: [' год', ' года', ' лет']}} и {{content.resume.count.seniority.months | integerToReadable: [' месяц', ' месяца', ' месяцев']}}"
			]) ?>
		</li>
		<li>
			<?= Html::tag('label', 'Проектов:') ?>
			{{content.resume.count.project || '0'}}
		</li>
	</ul>

	<ul class="col-sm-266 col-md-3 col-area">
		<li>
			<?= Html::tag('label', 'Время в пути:') ?>
			{{content.resume.time.text}}
		</li>
		<li>
			<?= Html::tag('label', 'Коммандировки:') ?>
			{{content.resume.trip.text}}
		</li>
		<li>
			<?= Html::tag('label', 'Переезд:') ?>
			{{content.resume.move.text}}
		</li>
	</ul>

	<ul class="col-sm-266 col-md-3 col-time">
		<li>
			<?= Html::tag('label', 'Тип занятости:') ?>
			{{content.resume.employment.text}}
		</li>
		<li>
			<?= Html::tag('label', 'Оклад:') ?>
			{{content.resume.salary || '0'}} ₽
		</li>
		<?= html::tag('li', $linkResumeSettings, [
			'ng-if' => 'user.id === content.id',
			'class' => 'edit-wrapper',
		]); ?>
	</ul>

</div>