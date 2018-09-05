<?php
/**
 * Configuration file for the "yii asset" console command.
 */

// In the console environment, some path aliases may not exist. Please define these:
Yii::setAlias('@webroot', __DIR__ . '/../web');
Yii::setAlias('@web', '/');

return [
	// Adjust command/callback for JavaScript files compressing:
	'jsCompressor' => 'java -jar compiler.jar --js {from} --js_output_file {to}',
	// Adjust command/callback for CSS files compressing:
	'cssCompressor' => 'java -jar yuicompressor.jar --type css {from} -o {to}',
	// Whether to delete asset source after compression:
	'deleteSource' => true,
	// The list of asset bundles to compress:
	'bundles' => [
		'yii\web\YiiAsset',
		'yii\bootstrap\BootstrapAsset',
		'yii\bootstrap\BootstrapPluginAsset',
		'frontend\assets\BowerAsset',
		'frontend\assets\SpaAsset',
	],
	// Asset bundle for compression output:
	'targets' => [
		'app' => [
			'class' => 'yii\web\AssetBundle',
			'basePath' => '@webroot/assets',
			'baseUrl' => '@web/assets',
			'js' => '{hash}.js',
			'css' => '{hash}.css',
		],
	],
	// Asset manager configuration:
	'assetManager' => [
		'basePath' => '@webroot/assets',
		'baseUrl' => '@web/assets',
	],
];
