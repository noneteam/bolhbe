<?php

namespace frontend\assets;

/**
 * Bower asset bundle.
 * Connecting AngularJS modules and jQuery.mmenu distributions
 */
class BowerAsset extends \yii\web\AssetBundle
{
	public $sourcePath = '@bower';
	public $css = [
		'font-awesome/css/font-awesome.css',
		'jQuery.mmenu/dist/css/jquery.mmenu.all.css',
		//'oi.select/dist/select.min.css'
		'textAngular/dist/textAngular.css',
	];
	public $js = [
		'autobahn-old-version/autobahn.min.js',
		'jQuery.mmenu/dist/js/jquery.mmenu.all.min.js',
		'angular/angular.js',
		'angular-ui-router/release/angular-ui-router.js',
		'angular-ui-router-title/angular-ui-router-title.js',
		'ui-router-extras/release/ct-ui-router-extras.js',
		//'angular-sanitize/angular-sanitize.js',
		'angular-ui-mask/dist/mask.js',
		'angular-i18n/angular-locale_ru-ru.js',
		'oi.select/dist/select-tpls.js',
		'textAngular/dist/textAngular-rangy.min.js',
		'textAngular/dist/textAngular-sanitize.js',
		'textAngular/dist/textAngular.min.js',
		'angular-bootstrap/ui-bootstrap-tpls.js',
	];
	public $jsOptions = [
		'position' => \yii\web\View::POS_HEAD,
	];
	public $depends = [
	];
}
