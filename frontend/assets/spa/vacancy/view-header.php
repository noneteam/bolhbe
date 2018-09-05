<?php

use yii\helpers\Html;

$positionText = Html::tag('span', '{{content.position.text}}');

$scopeLink = Html::a('{{content.scope.text}}', null, [
	'ui-sref' => 'vacancy>list({scope: content.scope.id})',
]);

$iconBuilding = Html::tag('i', null, [
	'class' => 'fa fa-building-o',
]);

$nameFamily = "{{content.user.profile.name}}{{content.user.profile.family ? ' '+content.user.profile.family : 'Гость'}}";

?>

<div class="container">

	<?= Html::tag('h3', "$iconBuilding {{content.company_place.text || content.user.company.title.text}}") ?>

	<?= Html::tag('h1', "$positionText в $scopeLink") ?>

	<h4>
		<?= Html::a($nameFamily, null, [
			'ui-sref' => 'user>view({id: content.user.id})',
			'ng-show' => 'content.user.profile.family',
		]). Html::tag('span', $nameFamily, [
			'ng-hide' => 'content.user.profile.family'
		]); ?>, <?= Html::tag('span', '{{content.created_at * 1000 | date: \'d MMM y\'}}'); ?>
	</h4>

</div>