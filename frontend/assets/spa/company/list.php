<?php

use yii\helpers\Html;

$linkProfile = Html::a('{{item.title.text}}', null, [
	'ui-sref' => 'user>view({id: item.user.id})',
]);

$iconLocation = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-map-marker'
]);

$linkFilter = Html::a('{{value.text}}', null, [
	'ng-click' => 'setFilter(key, value.id)',
]);

$listFilter = Html::tag('li', $linkFilter, [
	'ng-repeat' => 'value in filter'
]);

$iconFilter = Html::tag('i', null, [
	'class' => 'fa fa-sliders fa-rotate-90',
]);

?>

<div class="container list-container">

	<div class="row">

		<div class="col-sm-3 collapse" id="filters" ng-class="{'pull-right in': showFilters()}">
			<div class="filters">
				<?= Html::tag('ul', $listFilter, [
					'ng-repeat' => '(key, filter) in filters',
					'ng-hide' => 'hideCities(key)'
				]); ?>
			</div>
		</div>

		<div class="col-sm-9">

			<?= Html::button($iconFilter, [
				'data-toggle' => 'collapse',
				'data-target' => '#filters',
				'class' => 'btn btn-default btn-md hidden-sm hidden-md hidden-lg',
				'id' => 'toggle-filters',
			]); ?>

			<?= Html::tag('h1', '{{title}}') ?>

			<?= Html::tag('div', 'Показаны <b>{{pagination.defaultPageSize < pagination.totalCount ? pagination.defaultPageSize : pagination.totalCount}}</b> из <b>{{pagination.totalCount}}</b> компаний.', [
				'class' => 'summary'
			]); ?>

			<div ng-repeat="item in items" class="item">

				{{item.user.profile.name}} {{item.user.profile.family}}

				<?= Html::tag('h3', $linkProfile) ?>

				<?= Html::tag('span', "$iconLocation {{item.user.profile.city.text}}") ?>

			</div>

			<?= Html::tag('ul', null, [
				'uib-pagination' => true,
				'ng-model' => 'pagination.currentPage',
				'ng-change' => 'pageChanged()',
				'total-items' => 'pagination.totalCount',
				'items-per-page' => 'pagination.defaultPageSize',
				'rotate' => 'false',
				'max-size' => '5',
				'previous-text' => '‹',
				'next-text' => '›',
				'first-text' => '«',
				'last-text' => '»',
				'ng-if' => 'pagination.defaultPageSize<pagination.totalCount'
			]); ?>

		</div>
	</div>
</div>
