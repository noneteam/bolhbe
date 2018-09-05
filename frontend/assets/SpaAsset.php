<?php

namespace frontend\assets;

/**
 * Main SPA application asset bundle.
 */
class SpaAsset extends \yii\web\AssetBundle
{
	public $basePath = 'frontend/assets/spa';
	public $baseUrl = '@web';
	public $css = [
		'app.css',

		'mmenu.css',

		'oiselect.css',

		'default/style.css',

		'user/style.css',

		'vacancy/style.css',

		'resume/style.css',

		'company/style.css',
	];
	public $js = [
		'app.js',
		'google.js',
		'filters.js',
		'directives.js',

		'default/states.js',
		'default/controllers.js',

		'user/states.js',
		'user/controllers.js',

		'resume/states.js',
		'resume/controllers.js',

		'company/states.js',
		'company/controllers.js',

		'vacancy/states.js',
		'vacancy/controllers.js',
		'vacancy/directives.js',
	];
	public $depends = [
	];
}
