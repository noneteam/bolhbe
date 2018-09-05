<?php
/**
 * Форма создания и изменения опыта работы
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

$removeIcon = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-remove'
]);

$calendarIcon = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-calendar'
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="experience.submitFn('experience')" ng-init="experience.initFn()" mmenu-auto>

	<div class="go-blur">

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

			<?= Html::tag('label', 'Название компании', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: ООО "ГазПром"',
				'oi-options' => 'item.text for item in tags.load("company/place", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("company", "place", $query)\',}',
				'ng-model' => 'model.place',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Короткое описание', ['class' => 'control-label', 'for' => 'company-form-content']); ?>

			<?= Html::tag('text-angular', null, [
				'id' => 'company-form-content',
				'ng-model' => 'model.content',
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

			<?= Html::tag('label', 'Регион', ['class' => 'control-label', 'for' => 'profile-update-form-region']); ?>

			<?= Html::tag('oi-select', null, [
				'oi-options' => 'item.text for item in tags.load("location/region", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("location", "region", $query)\',}',
				'ng-model' => 'model.region',
			]); ?>

		</div>

		<div class="row">

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Дата приема', ['class' => 'control-label', 'for' => 'experience-form-hired']); ?>

				<div class="input-group">
					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'experience-form-hired',
						'class' => 'form-control',
						'uib-datepicker-popup' => 'yyyy, MMM',
						'ng-model' => 'options.stamp.hired',
						'ng-readonly' => 'true',
						'is-open' => 'isOpenCalendarHire',
						'datepicker-options' => 'options.date',
						'show-button-bar' => 'false',
					]); ?>
					<?= Html::tag('span', $calendarIcon, [
						'class' => 'input-group-addon',
						'ng-click' => 'isOpenCalendarHire = true',
					]); ?>
				</div>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Дата увольнения', ['class' => 'control-label', 'for' => 'experience-form-dismissed']); ?>

				<div class="input-group">
					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'experience-form-dismissed',
						'class' => 'form-control',
						'uib-datepicker-popup' => 'yyyy, MMM',
						'ng-model' => 'options.stamp.dismissed',
						'ng-readonly' => 'true',
						'is-open' => 'isOpenCalendarDismissed',
						'datepicker-options' => 'options.date',
						'show-button-bar' => 'false',
					]); ?>
					<?= Html::tag('span', $removeIcon, [
						'class' => 'input-group-addon',
						'ng-click' => 'options.stamp.dismissed = null',
					]); ?>
					<?= Html::tag('span', $calendarIcon, [
						'class' => 'input-group-addon',
						'ng-click' => 'isOpenCalendarDismissed = true',
					]); ?>
				</div>

			</div>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>