<?php
/**
 * Меню навигации по профилю
 */
use yii\helpers\Html;

$iconSignout = Html::tag('i', null, [
	'class' => 'fa fa-sign-out',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title']) ?>

<ul class="list-group" mmenu-auto='{"min": true}'>

	<li class="list-group-item">
		<?= Html::a('Редактировать профиль', null, [
			'ui-sref' => 'user>form',
		]); ?>
	</li>

	<li class="list-group-item">
		<?= Html::a('Изменить пароль', null, [
			'ui-sref' => 'user>password>form'
		]); ?>
	</li>

	<li class="list-group-item">
		<?= Html::a('{{options.phone.connect ? "Присоединить" : "Изменить"}} телефон', null, [
			'ui-sref' => 'user>phone>form',
		]); ?>
	</li>

	<li class="list-group-item" ng-show="options.facebook.show">
		<?= Html::a('Присоединить Facebook', null, [
			'ng-click' => 'connectFb()',
		]); ?>
	</li>

	<li class="list-group-item">
		<?= Html::a('{{options.resume.label}}', null, [
			'ui-sref' => 'resume>form',
			'ng-class' => "{'blur': options.resume.disabled}",
		]); ?>
	</li>

	<li class="list-group-item">
		<?= Html::a("{{options.company.label}}", null, [
			'ui-sref' => 'company>form',
			'ng-class' => "{'blur': options.company.disabled}",
		]); ?>
	</li>

	<li class="list-group-item menu-my-vacancy">
		<?= Html::a('Мои вакансии', null, [
			'ng-click' => 'goVacancy()'
		]); ?>
	</li>

	<li class="list-group-item">
		<?= Html::a('Добавить вакансию', null, [
			'ui-sref' => 'vacancy>form'
		]); ?>
	</li>

	<li class="submit-panel">
		<?= Html::button($iconSignout . Html::tag('span', 'Выйти', ['class' => 'hidden-xs']), [
			'class' => 'btn btn-primary btn-lg pull-right',
			'ng-click' => 'logout()',
			'title' => 'Выйти',
		]); ?>
	</li>

	<hr />

	<?= Html::tag('p', "<b>Внимание!</b> Необходимо отредактировать профиль чтоб была возможность создавать резюме или компанию.", [
		'class' => 'alert alert-default',
		'ng-show' => 'options.company.disabled'
	]); ?>

</ul>
