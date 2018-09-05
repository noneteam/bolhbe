<?php
/**
 * Форма изменения пароля
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button("$iconSave " . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'type' => 'submit',
	'class' => 'btn btn-success btn-lg pull-right',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel2", "min": true}'>

	<div class="go-blur">

		<?= Html::tag('p', 'Укажите текущий и новый пароли:'); ?>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Текущий пароль', ['class' => 'control-label', 'for' => 'profile-password-form-password']); ?>

			<?= Html::tag('input', null, [
				'type' => 'password',
				'id' => 'profile-password-form-password',
				'class' => 'form-control',
				'ng-model' => 'model.password',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Новый пароль', ['class' => 'control-label', 'for' => 'profile-password-form-password_new']); ?>

			<?= Html::tag('input', null, [
				'type' => 'password',
				'id' => 'profile-password-form-password_new',
				'class' => 'form-control',
				'ng-model' => 'model.password_new',
			]) ?>

		</div>

		<?= Html::tag('div', $submitButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>