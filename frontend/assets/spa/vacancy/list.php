<?php

use yii\helpers\Html;

$iconPlus = Html::tag('i', null, [
	'class' => 'fa fa-plus',
]);

$addButton = Html::a("$iconPlus Добавить вакансию", null, [
	'ui-sref' => 'vacancy>form',
	'ui-sref-active' => 'active',
	'class' => 'btn btn-default btn-md btn-add-content prevented-link',
]);

$linkVacancy = Html::a('{{item.position.text}}', null, [
	'ui-sref' => 'vacancy>view({id: item.id})',
]);

$iconLocation = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-map-marker'
]);

$iconBuilding = Html::tag('i', null, [
	'class' => 'fa fa-building-o',
	'style' => 'position: relative; top: -1px;'
]);

$linkFilter = Html::a('{{value.text}}', null, [
	'ng-click' => 'setFilter(key, value.id)',
	'ng-attr-title' => 'Работа в {{value.text}}',
]);

$listFilter = Html::tag('li', $linkFilter, [
	'ng-repeat' => 'value in filter'
]);

$iconFilter = Html::tag('i', null, [
	'class' => 'fa fa-sliders fa-rotate-90',
]);

?>

<div class="container list-container list-vacancy">

	<div class="row">

		<div class="col-sm-3 collapse" id="filters" ng-class="{'pull-right in': showFilters()}">

			<?= $this->render('list-sidebar-header') ?>

			<div class="filters">
				<?= Html::tag('ul', $listFilter, [
					'ng-repeat' => '(key, filter) in filters',
					'ng-hide' => 'hideCities(key)'
				]); ?>
			</div>

			<?= $this->render('list-sidebar-footer') ?>

		</div>

		<div class="col-sm-9">

			<?= Html::button($iconFilter, [
				'data-toggle' => 'collapse',
				'data-target' => '#filters',
				'class' => 'btn btn-default btn-md hidden-sm hidden-md hidden-lg',
				'id' => 'toggle-filters',
			]); ?>

			<?= Html::tag('h1', '{{title}}') ?>

			<?= Html::tag('div', 'Показаны <b>{{pagination.defaultPageSize < pagination.totalCount ? pagination.defaultPageSize : pagination.totalCount}}</b> из <b>{{pagination.totalCount}}</b> вакансий.', [
				'class' => 'summary'
			]); ?>

			<?= $addButton; ?>

			<div ng-repeat="item in items" class="item">

				{{item.user.profile.name || 'Гость'}}

				{{item.user.profile.family ? ' '+item.user.profile.family : ''}},

				{{item.created_at * 1000 | date: 'd MMM'}}

				<?= Html::tag('h3', $linkVacancy) ?>

				<?= Html::tag('span', "$iconBuilding {{item.company_place.text || item.user.company.title.text}}") ?>

				<?= Html::tag('span', "$iconLocation {{item.city.text}}") ?>

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
