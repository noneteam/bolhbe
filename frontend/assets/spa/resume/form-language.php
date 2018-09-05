<?php
/**
 * Форма создания и изменения языка
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

<form ng-submit="submitFn('language')" mmenu-auto>

	<div class="go-blur">

		<div class="form-group field-response">

			<?= Html::tag('label', 'Язык', ['class' => 'control-label', 'for' => 'language-form-language']); ?>

			<?= Html::dropDownList('language-form-language', null, [], [
				'id' => 'language-form-language',
				'ng-options' => 'label as label.text for label in options.labels.language track by label.id',
				'ng-model' => 'model.language',
				'class' => 'form-control',
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Уровень', ['class' => 'control-label', 'for' => 'language-form-level']); ?>

			<?= Html::dropDownList('language-form-level', null, [], [
				'id' => 'language-form-level',
				'ng-options' => 'label as label.text for label in options.labels.level track by label.id',
				'ng-model' => 'model.level',
				'class' => 'form-control',
			]); ?>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>