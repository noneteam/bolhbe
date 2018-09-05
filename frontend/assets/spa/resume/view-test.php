<?php
/**
 * Отображение списка пройденных тестов
 */
use yii\helpers\Html;

$iconBuilding = Html::tag('i', null, [
	'class' => 'fa fa-building-o',
]);

?>

<?= Html::tag('h2', 'Тесты и экзамены') ?>

<?= Html::button($add, [
	'ui-sref' => 'resume>test>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link btn btn-add-content',
	'ng-if' => 'user.id === content.id',
]); ?>

<div ng-repeat="test in content.resume.test | orderBy:'-id'">

	<div class="panel panel-default">

		<?= Html::tag('div', "$iconBuilding {{test.company_place.text}}", [
			'class' => 'panel-heading'
		]) ?>

		<div class="panel-body">

			<?= Html::tag('h4', '{{test.text}}') ?>

			<?= Html::button($edit, [
				'ui-sref' => 'resume>test>form({id: test.id})',
				'class' => 'prevented-link pull-right btn-link',
				'ng-if' => 'user.id === content.id'
			]); ?>

		</div>

	</div>

</div>
