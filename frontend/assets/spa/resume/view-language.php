<?php
/**
 * Отображение списка языков
 */
use yii\helpers\Html;

$iconLanguage = Html::tag('i', null, [
	'class' => 'fa fa-language',
]);

?>

<?= Html::tag('h2', 'Владение языками') ?>

<?= Html::button($add, [
	'ui-sref' => 'resume>language>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link btn btn-add-content',
	'ng-if' => 'user.id === content.id',
]); ?>

<div ng-repeat="language in content.resume.language | orderBy:'-id'">

	<div class="panel panel-default">

		<div class="panel-body">

			<?= Html::tag('h3', "$iconLanguage {{language.language.text}}") ?>

			{{language.level.text}}

			<?= Html::button($edit, [
				'ui-sref' => 'resume>language>form({id: language.id})',
				'class' => 'prevented-link pull-right btn-link',
				'ng-if' => 'user.id === content.id'
			]); ?>

		</div>

	</div>

</div>