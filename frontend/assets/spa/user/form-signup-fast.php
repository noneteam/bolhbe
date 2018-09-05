<?php
/**
 * Форма быстрой регистрации пользователя
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Далее', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-success btn-lg pull-right',
	'type' => 'submit',
]);

$toggleModelLink = Html::a('Обычная', null, [
	'ui-sref' => 'user>signup',
]);

$toggleModelWrapper = Html::tag('p', "$toggleModelLink регистрация.");

?>

<?= Html::tag('h2', '{{ $title }}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel2", "min": true}'>

	<div class="go-blur">

		<?= Html::tag('p', 'Для регистрации заполните указанные ниже поля:'); ?>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Номер телефона', ['class' => 'control-label', 'for' => 'go-form-phone']); ?>

			<?= Html::tag('input', null, [
				'type' => 'tel',
				'id' => 'go-form-phone',
				'class' => 'form-control',
				'ng-model' => 'model.phone',
				'ui-mask' => '(999) 999 99 99',
				'ui-mask-placeholder' => ' ',
				'ui-mask-placeholder-char' => 'space',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<?= $this->render('_privacypolicy') ?>

		<?= Html::tag('div', $submitButton . $toggleModelWrapper, [
			'class' => 'submit-panel'
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>