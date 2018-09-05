<?php
/**
 * Отображение списка пройденных курсов
 */
use yii\helpers\Html;

?>

<?= Html::tag('h2', 'Дополнительные курсы') ?>

<?= Html::a($add, null, [
	'ui-sref' => 'resume>course>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link btn btn-add-content',
	'ng-if' => 'user.id === content.id',
]); ?>

<div ng-repeat="course in content.resume.course | orderBy:'-id'">
	<div class="panel-body">

		<?= Html::tag('i', null, [
			'class' => 'course-sertificate',
			'ng-class' => "{'has': course.certificate.id == 2}"
		]) ?>

		<?= Html::tag('h4', Html::tag('small', '{{course.company_place.text}}') . '{{course.text}}') ?>

		<?= Html::button($edit, [
			'ui-sref' => 'resume>course>form({id: course.id})',
			'class' => 'prevented-link pull-right btn-link',
			'ng-if' => 'user.id === content.id',
		]); ?>

	</div>
</div>
