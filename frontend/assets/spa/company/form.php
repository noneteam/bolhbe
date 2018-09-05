<?php
/**
 * Форма создания и изменения компании
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button("$iconSave " . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'type' => 'submit',
	'class' => 'btn btn-success btn-lg pull-right',
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

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']); ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel2"}'>

	<div class="go-blur">

		<div class="form-group field-response">

			<?= Html::tag('label', 'Название компании', ['class' => 'control-label']); ?>

			<?= Html::tag('oi-select', null, [
				'placeholder' => 'На пример: ООО "ГазПром"',
				'oi-options' => 'item.text for item in tags.load("company/place", $query)',
				'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("company", "place", $query)\',}',
				'ng-model' => 'model.title',
				'mmenu-focus' => true,
			]); ?>

		</div>

		<div class="form-group field-response">

			<?= Html::tag('label', 'Категория', ['class' => 'control-label', 'for' => 'company-form-scope']); ?>

			<?= Html::dropDownList('company-form-scope', null, [], [
				'id' => 'company-form-scope',
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

		<?= Html::tag('div', 'Контактная информация', [
			'role' => 'button',
			'data-toggle' => 'collapse',
			'href' => '#contacts',
			'aria-expanded' => 'false',
		]) ?>

		<div class="collapse" id="contacts">

			<div class="form-group field-response">

				<?= Html::tag('label', 'Телефон', ['class' => 'control-label', 'for' => 'company-form-phone']); ?>

				<?= Html::tag('input', null, [
					'type' => 'tel',
					'id' => 'company-form-phone',
					'class' => 'form-control',
					'ng-model' => 'model.phone',
					'ui-mask' => '+7 (9999) 99-99-99',
					'ui-mask-placeholder' => ' ',
					'ui-mask-placeholder-char' => 'space',
				]); ?>

			</div>

			<div class="form-group field-response">

				<?= Html::tag('label', 'Сайт', ['class' => 'control-label', 'for' => 'company-form-site']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'company-form-site',
					'class' => 'form-control',
					'ng-model' => 'model.site',
				]); ?>

			</div>

			<div class="form-group field-response">

				<?= Html::tag('label', 'Email', ['class' => 'control-label', 'for' => 'company-form-email']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'company-form-email',
					'class' => 'form-control',
					'ng-model' => 'model.email',
				]); ?>

			</div>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>