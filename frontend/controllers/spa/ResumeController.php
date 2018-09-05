<?php

namespace frontend\controllers\spa;

/**
 * Resume templates controller
 */
class ResumeController extends \common\components\RailsTemplate
{
	public $actions = [
		'list',
		'empty',
		'view',
		'form',
		'form-experience',
		'form-university',
		'form-language',
		'form-course',
		'form-test',
	];
}
