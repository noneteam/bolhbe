<?php
/**
 * Форма регистрации пользователя
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o',
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Далее', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-success btn-lg pull-right',
	'type' => 'submit',
]);

$toggleModelLink = Html::a('Быстрая', null, [
	'ui-sref' => 'user>signup>fast',
]);

$toggleModelWrapper = Html::tag('p', "$toggleModelLink регистрация.");

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn('SignupFormExtra')" mmenu-auto='{"panel": "panel2"}'>

	<div class="go-blur">

		<?= Html::tag('p', 'Для регистрации выбери роль и заполни поля ниже:'); ?>

		<div class="row">

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Имя', ['class' => 'control-label', 'for' => 'signup-form-name']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'signup-form-name',
					'class' => 'form-control',
					'ng-model' => 'model.name',
					'mmenu-focus' => true,
				]) ?>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Фамилия', ['class' => 'control-label', 'for' => 'signup-form-family']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'signup-form-family',
					'class' => 'form-control',
					'ng-model' => 'model.family',
				]) ?>

			</div>

		</div>

		<div class="form-group field-response">
			<div id="roleSelect">

				<div class="col-sm-6" ng-class="{'active': model.role === 'worker'}">

					<?= Html::tag('label', 'Я Соискатель'); ?>

					<ul ng-click="model.role = 'worker'">
						<li>Создать резюме
						<li>Выйти на работу
						<li>Участвовать в проектах
					</ul>

				</div>

				<div class="col-sm-6" ng-class="{'active': model.role === 'employer'}">

					<?= Html::tag('label', 'Я Работадатель'); ?>

					<ul ng-click="model.role = 'employer'">
						<li>Создать компанию
						<li>Публиковать вакансии
						<li>Пригласить на работу
					</ul>

				</div>

				<?= Html::tag('br', null, ['style' => 'clear: both;', 'ng-model' => 'model.role']); ?>

			</div>
		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Номер телефона', ['class' => 'control-label', 'for' => 'signup-form-phone']); ?>

			<?= Html::tag('input', null, [
				'type' => 'tel',
				'id' => 'signup-form-phone',
				'class' => 'form-control',
				'ng-model' => 'model.phone',
				'ui-mask' => '(999) 999 99 99',
				'ui-mask-placeholder' => ' ',
				'ui-mask-placeholder-char' => 'space',
			]) ?>

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

		<?= $this->render('_privacypolicy') ?>

		<?= Html::tag('div', $submitButton . $toggleModelWrapper, [
			'class' => 'submit-panel'
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>