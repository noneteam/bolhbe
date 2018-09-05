<?php

use yii\helpers\Html;

$labels = [
	'add' => Html::tag('i', null, [
		'class' => 'fa fa-plus',
	]) . ' Добавить',

	'edit' => Html::tag('i', null, [
		'class' => 'fa fa-sliders',
	]) . Html::tag('span', 'Настроить', [
		'class' => 'hidden-xs'
	])
];

?>

<div class="view-resume">

	<?= Html::tag('header', $this->render('view-header')) ?>

	<div class="container">

		<?= Html::tag('summary', $this->render('view-summary', $labels)) ?>

		<div class="row row-models">

			<?= Html::tag('div', $this->render('view-experience', $labels), [
				'class' => 'col-md-6 col-experience',
			]); ?>

			<div class="col-md-6">

				<?= Html::tag('div', $this->render('view-university', $labels), [
					'class' => 'col-university',
				]); ?>

				<?= Html::tag('div', $this->render('view-language', $labels), [
					'class' => 'col-language'
				]); ?>

				<?= Html::tag('div', $this->render('view-course', $labels), [
					'class' => 'col-course',
				]); ?>

				<?= Html::tag('div', $this->render('view-test', $labels), [
					'class' => 'col-test'
				]); ?>

			</div>

		</div>

	</div>


</div>