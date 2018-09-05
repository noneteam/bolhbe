<?php
/**
 * Отображение списка полученных образований
 */
use yii\helpers\Html;

$iconEducation = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-education',
]);

$iconUniversity = Html::tag('i', null, [
	'class' => 'fa fa-university',
]);

?>

<?= Html::tag('h2', 'Образование') ?>

<?= Html::button($add, [
	'ui-sref' => 'resume>university>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link btn btn-add-content',
	'ng-if' => 'user.id === content.id',
]); ?>

<div ng-repeat="university in content.resume.university | orderBy:'-id'" data-key="{{university.id}}">

	<div class="panel panel-default">

		<div class="panel-heading">

			<?= Html::tag('p', "$iconEducation {{university.faculty.text}}") ?>

			<?= $iconUniversity; ?> {{university.title.text}}

		</div>

		<?= Html::tag('h3', '{{university.specialty.text}}', [
			'class' => 'panel-body',
		]) ?>

		<div class="panel-footer">

			<?= Html::button($edit, [
				'ui-sref' => 'resume>university>form({id: university.id})',
				'class' => 'prevented-link pull-right btn-link',
				'ng-if' => 'user.id === content.id'
			]); ?>

			{{university.level.text}}, {{university.diploma.text}}

		</div>

	</div>

</div>