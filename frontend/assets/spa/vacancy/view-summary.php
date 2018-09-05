<?php

use yii\helpers\Html;

$edit = Html::tag('i', null, [
	'class' => 'fa fa-sliders',
]) . Html::tag('span', 'Редактировать', [
	'class' => 'hidden-xs'
]);

$linkVacancySettings = Html::button($edit, [
	'ui-sref' => 'vacancy>view>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link pull-right btn-link',
]);

?>

<div class="container">
	<div class="row break">

		<ul class="col-sm-3 col-phone">
			<li>
				<?= Html::tag('i', null, ['class' => 'fa fa-volume-control-phone']) ?>
				<?= Html::a('{{(content.phone || content.user.phone) | phone}}', 'tel: +7{{content.phone || content.user.phone}}', [
					'title' => '{{content.show_phone.text}}'
				]) ?>
			</li>
		</ul>

		<ul class="col-sm-3">

			<li>
				<?= Html::tag('label', 'Компания:') ?>
				<?= Html::a('{{content.company_place.text || content.user.company.title.text}}', null, [
					'ui-sref' => 'user>view({id: content.company_place ? "null" : content.user.company ? content.user.id : "null"})',
				]); ?>
			</li>

			<li>
				<?= Html::tag('label', 'Регион:') ?>
				<?= Html::a('{{content.region.text}}', null, [
					'ui-sref' => 'vacancy>list({region: content.region.id})',
				]); ?>
			</li>

			<li>
				<?= Html::tag('label', 'Город:') ?>
				{{content.city.text}}
			</li>

		</ul>

		<ul class="col-sm-3">

			<li>
				<?= Html::tag('label', 'Закрытие через:') ?>
				{{(content.expire || 1) | integerToReadable: [' день', ' дня', ' дней']}}
			</li>

			<li>
				<?= Html::tag('label', 'Тип занятости:') ?>
				{{content.employment.text}}
			</li>

			<li>
				<?= Html::tag('label', 'Оклад:') ?>
				{{content.salary || "0"}} ₽
			</li>

		</ul>

		<ul class="col-sm-3">

			<li>
				<?= Html::tag('label', 'Опыт работы:') ?>
				{{content.experience.text}}
			</li>

			<li>
				<?= Html::tag('label', 'Конкурс:') ?>
				{{content.content.count.response || '0'}}
			</li>

			<?= html::tag('li', $linkVacancySettings, [
				'ng-if' => 'user.id === content.user.id',
				'class' => 'edit-wrapper',
			]); ?>

		</ul>

	</div>
</div>