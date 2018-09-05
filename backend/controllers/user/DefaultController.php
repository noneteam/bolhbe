<?php

namespace backend\controllers\user;

/**
 * User default rest controller
 */
class DefaultController extends \common\components\RailsRest
{
	public $except = [
		'options',
		'create',
		'view',
	];

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\user\models\SignupForm,
				'allowModels' => [
					'SignupFormExtra' => new \common\modules\user\models\SignupFormExtra,
				]
			],
			'view' => [
				'class' => 'common\actions\ViewAction',
				'defaultModel' => \common\modules\user\models\UserView::className(),
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\user\models\UserProfileForm::className(),
				'allowModels' => [
					'PhoneUpdateForm' => \common\modules\user\models\PhoneUpdateForm::className(),
					'PhoneConnectForm' => \common\modules\user\models\PhoneConnectForm::className(),
					'PhoneAvailabilitySet' => \common\modules\user\models\PhoneAvailabilitySet::className(),
					'FacebookConnect' => \common\modules\user\models\FacebookConnect::className(),
				]
			],
			'delete' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\user\models\UserDeleteForm::className(),
			],
		], parent::actions());
	}
}
