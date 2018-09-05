<?php
/**
 * Форма создания и изменения резюме
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button($iconSave . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'type' => 'submit',
	'class' => 'btn btn-success btn-lg pull-right',
	'set-default-model' => true,
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

$userIcon = Html::tag('i', null, [
	'class' => 'fa fa-user'
]);

$userTimesIcon = Html::tag('i', null, [
	'class' => 'fa fa-user-times'
]);

$setResumeStatus = Html::button($userIcon, [
	'class' => 'btn',
	'title' => 'Сейчас свободен',
	'ng-click' => 'state.set(1)',
	'ng-disabled' => 'model.state.id === 1',
]). Html::button($userTimesIcon, [
	'class' => 'btn',
	'title' => 'Сейчас занят',
	'ng-click' => 'state.set(2)',
	'ng-disabled' => 'model.state.id === 2',
]);

$setResumeStatusWrapper = Html::tag('div', $setResumeStatus, [
	'class' => 'input-group',
	'ng-show' => 'model.id',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel2"}'>

	<div class="go-blur">

		<div class="form-group field-response">

			<?= Html::tag('label', 'Должности', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: Бухгалтер',
				'oi-options' => 'item.text for item in tags.load("vacancy/position", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("vacancy", "position", $query)\',}',
				'ng-model' => 'options.stamp.positions',
				'multiple' => true,
				'multiple-limit' => '5',
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

		<div class="row">

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Переезд', ['class' => 'control-label', 'for' => 'resume-form-move']); ?>

				<?= Html::dropDownList('resume-form-move', '', [], [
					'id' => 'resume-form-move',
					'class' => 'form-control',
					'ng-model' => 'model.move',
					'ng-options' => 'label as label.text for label in options.labels.move track by label.id',
				]); ?>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Коммандировка', ['class' => 'control-label', 'for' => 'resume-form-trip']); ?>

				<?= Html::dropDownList('resume-form-trip', null, [], [
					'id' => 'resume-form-trip',
					'class' => 'form-control',
					'ng-model' => 'model.trip',
					'ng-options' => 'label as label.text for label in options.labels.trip track by label.id',
				]) ?>
			</div>

			<div class="form-group col-sm-6 field-response">

				<?= Html::tag('label', 'Занятость', ['class' => 'control-label', 'for' => 'resume-form-employment']); ?>

				<?= Html::dropDownList('resume-form-employment', null, [], [
					'id' => 'resume-form-employment',
					'class' => 'form-control',
					'ng-model' => 'model.employment',
					'ng-options' => 'label as label.text for label in options.labels.employment track by label.id',
				]) ?>

			</div>

			<div class="form-group col-sm-6 field-response">

				<?= Html::tag('label', 'Время в пути', ['class' => 'control-label', 'for' => 'resume-form-time']); ?>

				<?= Html::dropDownList('resume-form-trip', null, [], [
					'id' => 'resume-form-trip',
					'class' => 'form-control',
					'ng-model' => 'model.time',
					'ng-options' => 'label as label.text for label in options.labels.time track by label.id',
				]) ?>
			</div>
		</div>

		<?= Html::tag('div', $submitButton . $deleteButton . $setResumeStatusWrapper, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>