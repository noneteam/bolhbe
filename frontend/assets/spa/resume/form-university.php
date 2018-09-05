<?php
/**
 * Форма создания и изменения образования
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

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn('university')" ng-init="options.default.level.id = 5" mmenu-auto>

	<div class="go-blur">

		<div class="form-group field-response">

			<?= Html::tag('label', 'Факультет', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: Физико-Математический',
				'oi-options' => 'item.text for item in tags.load("resume/faculty", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("resume", "faculty", $query)\',}',
				'ng-model' => 'model.faculty',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Название учреждения', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: Ингушский государственный университет (ИнгГу)',
				'oi-options' => 'item.text for item in tags.load("company/place", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("company", "place", $query)\',}',
				'ng-model' => 'model.title',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Специальность', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: Бухгалтер',
				'oi-options' => 'item.text for item in tags.load("vacancy/position", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("vacancy", "position", $query)\',}',
				'ng-model' => 'model.specialty',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Степень', ['class' => 'control-label', 'for' => 'university-form-level']); ?>

			<?= Html::dropDownList('university-form-level', null, [], [
				'id' => 'university-form-level',
				'ng-options' => 'label as label.text for label in options.labels.level track by label.id',
				'ng-model' => 'model.level',
				'class' => 'form-control',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Средняя оценка', ['class' => 'control-label', 'for' => 'university-form-diploma']); ?>

			<?= Html::dropDownList('university-form-diploma', null, [], [
				'id' => 'university-form-diploma',
				'ng-options' => 'label as label.text for label in options.labels.diploma track by label.id',
				'ng-model' => 'model.diploma',
				'class' => 'form-control',
			]); ?>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>