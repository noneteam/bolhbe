<?php

namespace frontend\controllers\spa;

/**
 * Company templates controller
 */
class CompanyController extends \common\components\RailsTemplate
{
	public $actions = [
		'list',
		'empty',
		'view',
		'form'
	];
}
