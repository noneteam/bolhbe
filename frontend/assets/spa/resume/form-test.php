<?php
/**
 * Форма создания и изменения теста
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

<form ng-submit="submitFn('test')" mmenu-auto>

	<div class="go-blur">

		<div class="form-group field-response">

			<?= Html::tag('label', 'Компания организатор', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: ООО "ГазПром"',
				'oi-options' => 'item.text for item in tags.load("company/place", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("company", "place", $query)\',}',
				'ng-model' => 'model.company_place',
				'mmenu-focus' => true,
			]); ?>
		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Название теста', ['class' => 'control-label', 'for' => 'course-form-phone']); ?>

			<?= Html::tag('textarea', null, [
				'type' => 'text',
				'id' => 'course-form-phone',
				'class' => 'form-control',
				'ng-model' => 'model.text',
			]); ?>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>
