<?php
/**
 * Форма изменения пароля после восстановления
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o',
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-success pull-right',
	'type' => 'submit',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title']); ?>

<form ng-submit="resetFn()"  mmenu-auto='{"panel": "panel3", "min": true}'>

	<?= Html::tag('p', 'Укажите новый пароль:'); ?>

	<div class="form-group field-response">

		<?= Html::tag('label', 'Новый пароль', ['class' => 'control-label', 'for' => 'restore-change-form-password']); ?>

		<?= Html::tag('input', null, [
			'type' => 'password',
			'id' => 'restore-change-form-password',
			'class' => 'form-control',
			'ng-model' => 'model.password',
			'mmenu-focus' => true,
		]) ?>

	</div>

	<?= Html::tag('div', $submitButton, [
		'class' => 'submit-panel',
	]); ?>

</form>

