<?php
/**
 * Форма авторизации пользователя
 */

use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-sign-in',
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Войти', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-lg btn-success pull-right',
	'type' => 'submit',
]);

$passwordResetLink = Html::a('Восстановить', null, [
	'ui-sref' => 'user>login>request',
]);

$passwordResetWrapper = Html::tag('p', "$passwordResetLink пароль.");

$signupLink = Html::a('Регистрируйся', null, [
	'ui-sref' => 'user>signup',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"min": true}'>

	<?= Html::tag('p', 'Вы можете заходить с помощью профиля в социальных сетях:') ?>

	<p align="center">

		<?= Html::button('Войти через фейсбук', [
			'ng-click' => 'submitFb()',
			'class' => 'btn btn-primary',
			'style' => 'background-color: #4267b2; border: 0'
		]); ?>

	</p>

	<?= Html::tag('hr', null) ?>

	<?= Html::tag('p', 'Либо авторизуйтесь заполнив указанные ниже поля:'); ?>

	<div class="form-group field-response">

		<?= Html::tag('label', 'Номер телефона', ['class' => 'control-label', 'for' => 'login-form-phone']); ?>

		<?= Html::tag('input', null, [
			'type' => 'tel',
			'id' => 'login-form-phone',
			'class' => 'form-control',
			'ng-model' => 'model.phone',
			'ui-mask' => '(999) 999 99 99',
			'ui-mask-placeholder' => ' ',
			'ui-mask-placeholder-char' => 'space',
			'mmenu-focus' => true,
		]); ?>

	</div>

	<div class="form-group field-response">

		<?= Html::tag('label', 'Пароль', ['class' => 'control-label', 'for' => 'login-form-password']); ?>

		<?= Html::tag('input', null, [
			'type' => 'password',
			'id' => 'login-form-password',
			'class' => 'form-control',
			'ng-model' => 'model.password',
		]) ?>

	</div>

	<?= Html::tag('hr', null, ['class' => 'visible-xs']) . Html::tag('p', "Впервые на сайте? $signupLink.", ['class' => 'visible-xs']); ?>

	<?= Html::tag('div', $submitButton . $passwordResetWrapper, [
		'class' => 'submit-panel'
	]); ?>

</form>