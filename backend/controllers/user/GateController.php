<?php

namespace backend\controllers\user;

use Yii;

/**
 * User gate in/out rest controller
 */
class GateController extends \common\components\RailsRest
{
	public $except = [
		'options',
		'index',
		'auth'
	];

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'auth' => [
				'class' => 'yii\authclient\AuthAction',
				'successCallback' => [$this, 'authRedirect'],
			],
			'index' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\user\models\LoginForm,
			],
		], parent::actions());
	}

	/**
	 * Auth success url redirect function
	 * @return redirect to $resultUrl
	 */
	public function authRedirect($client)
	{

		$resultUrl = 'error-gate.html';

		$c = $client->getUserAttributes();

		$data = [
			'family' => $c['last_name'],
			'name' => $c['first_name'],
			'email' => $c['email'],
			'facebook_hash' => $c['id']
		];

		if (Yii::$app->request->get('connect'))
			$resultUrl = "success-connect.html?client={$client->getId()}&token={$c['id']}";
		else {

			$model = new \common\modules\user\models\LoginFacebook;

			if (!$model->load($data, '') || !$token = $model->getAuthKey()) {

				$model = new \common\modules\user\models\SignupFacebook;

				$model->load($data, '');

				/**
				 * Removing not valid fields from model
				 */
				if (!$model->validate())
					foreach ($model->errors as $key => $field)
						$model->$key = null;

				if ($model->defaultAction())
					$token = $model->getAuthKey();

			}

			$resultUrl = "success-gate.html?token=$token";

		}

		$this->redirect("https://bolh.be/user/$resultUrl");

	}
}
