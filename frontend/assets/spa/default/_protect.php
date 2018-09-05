<?php
/**
 * Стандартное поле протекции
 */
use yii\helpers\Html;

$iconCheck = Html::tag('i', null, [
	'class' => 'fa fa-check'
]);

?>

<div class="form-group protect-show">

	<div class="input-group">

		<?= Html::tag('input', null, [
			'type' => 'tel',
			'id' => 'standard-form-protect',
			'class' => 'form-control disable-enter',
			'ng-model' => 'model.protect',
			'ui-mask' => '999 - 999',
			'ui-mask-placeholder' => ' ',
			'ui-mask-placeholder-char' => 'space',
		]); ?>

		<?= Html::button($iconCheck, [
			'type' => 'submit',
			'class' => 'btn btn-success',
		]); ?>

	</div>

</div>