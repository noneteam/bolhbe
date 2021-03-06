<?php
/**
 * Форма восстановления пароля
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o',
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Далее', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-success btn-lg pull-right',
	'type' => 'submit',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']); ?>

<form ng-submit="requestFn()" mmenu-auto='{"panel": "panel2", "min": true}'>

	<div class="go-blur">

		<?= Html::tag('p', 'Укажите телефон для восстановления пароля:'); ?>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Номер телефона', ['class' => 'control-label', 'for' => 'restore-form-phone']); ?>

			<?= Html::tag('input', null, [
				'type' => 'tel',
				'id' => 'restore-form-phone',
				'class' => 'form-control',
				'ng-model' => 'model.phone',
				'ui-mask' => '(999) 999 99 99',
				'ui-mask-placeholder' => ' ',
				'ui-mask-placeholder-char' => 'space',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<?= Html::tag('div', $submitButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>