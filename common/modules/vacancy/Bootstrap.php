<?php

namespace common\modules\vacancy;

class Bootstrap implements \yii\base\BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			'PUT vacancy/<id:\d+>' => 'vacancy/default/update',
			'DELETE vacancy/<id:\d+>' => 'vacancy/default/delete',
		], false);
	}
}