<?php
/**
 * Шаблон отображения вакансии
 */
use yii\helpers\Html;

$iconFacebook = Html::tag('i', null, [
	'class' => 'fa fa-facebook',
]);

$iconVk = Html::tag('i', null, [
	'class' => 'fa fa-vk',
]);

$iconTwitter = Html::tag('i', null, [
	'class' => 'fa fa-twitter',
]);

$iconPrint = Html::tag('i', null, [
	'class' => 'fa fa-print',
]);

?>

<div class="view-vacancy">

	<?= Html::tag('header', $this->render('view-header')) ?>

	<?= Html::tag('summary', $this->render('view-summary')); ?>

	<div class="container">
		<div class="row">

			<?= Html::tag('div', null, [
				'ng-bind-html' => 'content.content',
				'class' => 'col-md-9 col-content',
			]); ?>

			<div class="col-md-3 col-company">

				<?= Html::tag('label', 'О Компании:') ?>

				<?= Html::tag('div', null, [
					'ng-bind-html' => 'content.user.company.content'
				]); ?>

				<?= Html::tag('label', 'Поделиться в сети:', [
					'style' => 'display: block'
				]); ?>

				<?= Html::button($iconFacebook, [
					'sharebutton' => 'facebookcom',
					'class' => 'btn btn-medium',
				]); ?>

				<?= Html::button($iconVk, [
					'sharebutton' => 'vkcom',
					'class' => 'btn btn-medium',
				]); ?>

				<?= Html::button($iconTwitter, [
					'sharebutton' => 'twittercom',
					'class' => 'btn btn-medium',
				]); ?>

				<?= Html::a($iconPrint, 'javascript:window.print(); void 0;', [
					'class' => 'btn btn-medium btn-default',
					'target' => '_blank'
				]); ?>

			</div>

		</div>
	</div>


</div>