<?php

use yii\helpers\Html;

$linkCompanyScope = Html::a('{{content.company.scope.text}}', null, [
	'ui-sref' => 'company>list({scope: content.company.scope.id})',
]);

$linkProfileRegion = Html::a('{{content.profile.region.text}}', null, [
	'ui-sref' => 'company>list({region: content.profile.region.id})',
]);

?>

<div class="container">

	<?= Html::tag('h1', "{{content.company.title.text}} в $linkCompanyScope"); ?>

	<?= Html::tag('h4', "$linkProfileRegion, {{ content.profile.city.text }}"); ?>

</div>