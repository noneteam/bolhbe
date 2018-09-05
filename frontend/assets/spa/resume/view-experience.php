<?php
/**
 * Отображение опыта работы списком
 */
use yii\helpers\Html;

$iconBuilding = Html::tag('i', null, [
	'class' => 'fa fa-building-o',
]);

$iconLocation = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-map-marker',
]);

$period = '{{experience.dismissed}}
{{experience.hired}}';

?>

<?= Html::tag('h2', 'Опыт работы') ?>

<?= Html::button($add, [
	'ui-sref' => 'resume>experience>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link btn btn-add-content',
	'ng-if' => 'user.id === content.id',
]); ?>

<div class="row" ng-repeat="experience in content.resume.experience | orderBy: orderByDate">

	<div class="col-sm-10">

		<div class="panel panel-default">

			<div class="panel-heading">

				<?= Html::tag('h3', '{{experience.position.text}}') ?>

				<?= $iconBuilding ?>

				<?= Html::a('{{experience.place.text}}', null, [
					'ng-href' => '{{experience.site}}',
					'target' => '_blank',
				]); ?>, {{experience.region.text}}

			</div>

			<?= Html::tag('div', null, [
				'class' => 'panel-body',
				'ng-bind-html' => 'experience.content',
				'ng-if' => 'experience.content',
			]); ?>

			<div class="panel-footer">

				<?= Html::button($edit, [
					'class' => 'prevented-link pull-right btn-link',
					'ng-if' => 'user.id === content.id',
					'ui-sref' => 'resume>experience>form({id: experience.id})'
				]); ?>

				<?= Html::a('{{experience.scope.text}}', null, [
					'ui-sref' => 'company>list({scope: experience.scope.id})'
				]); ?>

			</div>

		</div>

	</div>

	<?= Html::tag('div', $period, [
		'class' => 'col-sm-2',
		'ng-class' => "{'dismissed': experience.dismissed}"
	]); ?>

</div>
