<?php

use yii\helpers\Html;

?>

<div class="error-page expired full-page" ng-init="goSearch()">

	<div class="container">

		<?= Html::tag('p', 'Вакансия истека <b>{{content.expired | integerToReadable: [" день", " дня", " дней"]}}</b> назад.'); ?>

	</div>

</div>