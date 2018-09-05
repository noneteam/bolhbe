<?php

namespace frontend\controllers\spa;

/**
 * Vacancy templates controller
 */
class VacancyController extends \common\components\RailsTemplate
{
	public $actions = [
		'list',
		'empty',
		'view',
		'expired',
		'form'
	];
}
