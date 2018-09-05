<?php

namespace common\components;

/**
 * Default rest controller
 */
class RailsRest extends \yii\rest\Controller
{
	public $except = [
		'options',
	];

	public $rules = [[
		'allow' => true,
		'roles' => ['@'],
	]];

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			'corsFilter' => [
				'class' => \yii\filters\Cors::className(),
				'cors' => [
					'Origin' => ['https://bolh.be'],
					'Access-Control-Request-Method' => ['POST', 'PUT', 'PATCH', 'DELETE'],
					'Access-Control-Request-Headers' => ['*'],
					'Access-Control-Allow-Credentials' => true,
					'Access-Control-Max-Age' => 3600,
					'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page']
				],
			],
			'authenticator' => [
				'class' => \yii\filters\auth\HttpBearerAuth::className(),
				'except' => $this->except,
			],
			'access' => [
				'class' => \yii\filters\AccessControl::className(),
				'except' => $this->except,
				'rules' => $this->rules,
			],
			'contentNegotiator' => [
				'class' => \yii\filters\ContentNegotiator::className(),
				'formats' => [
					'application/json' => \yii\web\Response::FORMAT_JSON,
				],
			],
			'rateLimiter' => [
				'class' => \ethercreative\ratelimiter\RateLimiter::className(),
				'rateLimit' => 200,
				'timePeriod' => 600,
				'separateRates' => false,
				'enableRateLimitHeaders' => false,
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'options' => [
				'class' => 'yii\rest\OptionsAction',
			]
		];
	}
}