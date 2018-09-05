<?php

namespace common\modules\user;

class Bootstrap implements \yii\base\BootstrapInterface
{
	public function bootstrap($app)
	{
		$app->getUrlManager()->addRules([
			'PUT user/password' => 'user/password/update',
			'PATCH user/password' => 'user/password/reset',
			'POST user/gate' => 'user/gate/index',
			'GET user/auth' => 'user/gate/auth',

			'OPTIONS user/password' => 'user/default/options',
			'OPTIONS user/gate' => 'user/default/options',
		], false);
	}
}