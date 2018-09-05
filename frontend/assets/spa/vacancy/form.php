<?php
/**
 * Форма создания и изменения вакансии
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'class' => 'btn btn-success btn-lg pull-right',
	'type' => 'submit',
]);

$iconDelete = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-trash'
]);

$deleteButton = Html::button($iconDelete, [
	'type' => 'submit',
	'class' => 'btn btn-danger btn-lg pull-right btn-delete',
	'ng-show' => 'model.id',
]);

$iconRub = Html::tag('i', null, [
	'class' => 'fa fa-rub'
]);

$iconRepeat = Html::tag('i', null, [
	'class' => 'fa fa-repeat'
]);

$userEye = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-eye-open'
]);

$userEyeSlash = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-eye-close'
]);

$setVacancyState = Html::button($userEye, [
		'type' => 'submit',
		'name' => 'status',
		'class' => 'btn',
		'title' => 'Показать вакансию',
		'ng-hide' => 'model.status_id == 1',
		'ng-disabled' => 'model.status_id != 9',
		'ng-click' => 'options.request.setModel = "VacancyShow"',
	]). Html::button($userEyeSlash, [
		'type' => 'submit',
		'name' => 'status',
		'value' => '9',
		'class' => 'btn',
		'title' => 'Скрыть вакансию',
		'ng-hide' => 'model.status_id == 1',
		'ng-disabled' => 'model.status_id != 10',
		'ng-click' => 'options.request.setModel = "VacancyHide"',
	]). Html::button($iconRepeat, [
		'type' => 'submit',
		'class' => 'btn',
		'title' => 'Продлить вакансию',
		'ng-show' => 'model.status_id == 1',
		'ng-click' => 'options.request.setModel = "VacancyProlong"',
	]);

$setVacancyStateWrapper = Html::tag('div', $setVacancyState, [
	'class' => 'input-group',
	'ng-show' => 'model.id',
]);

?>

<?= Html::tag('h2', "{{model.id ? 'Изменить' : 'Добавить'}} вакансию", ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel2"}'>

	<div class="go-blur">

		<?= Html::tag('div', "<p><strong>Внимание!</strong></p><p>Срок действия вакансии истек {{model.expire_at * 1000 | date: 'd MMMM'}}. Продли вакансию на 30 дней нажав на $iconRepeat в подвале формы.</p>", [
			'class' => 'alert alert-info',
			'ng-if' => 'model.status.id == 1',
		]); ?>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Должность', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: Бухгалтер',
				'oi-options' => 'item.text for item in tags.load("vacancy/position", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("vacancy", "position", $query)\',}',
				'ng-model' => 'model.position',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Категория', ['class' => 'control-label', 'for' => 'resume-form-scope']); ?>

			<?= Html::dropDownList('resume-form-scope', null, [], [
				'id' => 'resume-form-scope',
				'ng-options' => 'label as label.text for label in options.labels.scope track by label.id',
				'ng-model' => 'model.scope',
				'class' => 'form-control',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Короткое описание', ['class' => 'control-label', 'for' => 'company-form-content']); ?>

			<?= Html::tag('text-angular', null, [
				'id' => 'company-form-content',
				'ng-model' => 'model.content',
			]); ?>

		</div>

		<?= Html::tag('div', 'Особые условия', [
			'role' => 'button',
			'data-toggle' => 'collapse',
			'href' => '#extraOptions',
		]); ?>

		<div class="row collapse" id="extraOptions">

			<div class="form-group field-response col-sm-7">

				<?= Html::tag('label', 'Название компании', ['class' => 'control-label']); ?>

				<?= Html::tag('oi-select', null, [
					'placeholder' => 'На пример: ООО "ГазПром"',
					'oi-options' => 'item.text for item in tags.load("company/place", $query)',
					'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("company", "place", $query)\',}',
					'ng-model' => 'model.company_place',
				]); ?>

			</div>

			<div class="form-group field-response col-sm-5">

				<?= Html::tag('label', 'Оклад', ['class' => 'control-label', 'for' => 'resume-form-salary']); ?>

				<div class="input-group">
					<?= Html::tag('input', null, [
						'ng-model' => 'model.salary',
						'type' => 'number',
						'id' => 'resume-form-salary',
						'class' => 'form-control',
					]); ?>
					<?= Html::tag('span', $iconRub, ['class' => 'input-group-addon']) ?>
				</div>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Занятость', ['class' => 'control-label', 'for' => 'resume-form-employment']); ?>

				<?= Html::dropDownList('resume-form-employment', null, [], [
					'id' => 'resume-form-employment',
					'class' => 'form-control',
					'ng-model' => 'model.employment',
					'ng-options' => 'label as label.text for label in options.labels.employment track by label.id',
				]) ?>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Опыт работы', ['class' => 'control-label', 'for' => 'resume-form-employment']); ?>

				<?= Html::dropDownList('resume-form-employment', null, [], [
					'id' => 'resume-form-employment',
					'class' => 'form-control',
					'ng-model' => 'model.experience',
					'ng-options' => 'label as label.text for label in options.labels.experience track by label.id',
				]) ?>

			</div>

		</div>

		<?= Html::tag('div', 'Местонахождение', [
			'role' => 'button',
			'data-toggle' => 'collapse',
			'href' => '#location',
		]); ?>

		<div class="collapse in" id="location">

			<div class="form-group field-response">

				<?= Html::tag('label', 'Регион', ['class' => 'control-label', 'for' => 'profile-update-form-region']); ?>

				<?= Html::tag('oi-select', null, [
					'oi-options' => 'item.text for item in tags.load("location/region", $query)',
					'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("location", "region", $query)\',}',
					'ng-model' => 'model.region',
				]); ?>

			</div>

			<div class="form-group field-response">

				<?= Html::tag('label', 'Город', ['class' => 'control-label', 'for' => 'profile-update-form-city']); ?>

				<?= Html::tag('oi-select', null, [
					'oi-options' => 'item.text for item in tags.load("location/city", $query)',
					'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("location", "city", $query)\',}',
					'ng-model' => 'model.city',
				]); ?>

			</div>

		</div>

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
			]); ?>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton . $setVacancyStateWrapper, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>