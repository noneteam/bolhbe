<?php

namespace frontend\controllers\spa;

/**
 * Default templates controller
 */
class DefaultController extends \common\components\RailsTemplate
{
	public $actions = [
		'index',
		'404'
	];
}
