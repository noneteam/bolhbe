<?php

namespace backend\controllers\user;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

/**
 * User password update/restore rest controller
 */
class PasswordController extends \common\components\RailsRest
{
	public function __construct($id, $module, $config = [])
	{
		$this->except = array_merge([
			'index',
			'create',
			'reset'
		], $this->except);

		parent::__construct($id, $module, $config);
	}

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return array_merge([
			'create' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => new \common\modules\user\models\PasswordRequestForm,
			],
			'update' => [
				'class' => 'common\actions\FormAction',
				'defaultModel' => \common\modules\user\models\PasswordUpdateForm::className(),
			],
		], parent::actions());
	}

	/**
	 * @inheritdoc
	 */
	public function actionReset()
	{
		try {
			$model = new \common\modules\user\models\PasswordResetForm();
		} catch (InvalidParamException $e) {
			throw new BadRequestHttpException($e->getMessage());
		}

		if ($model->load(Yii::$app->request->post(), ''))
			if ($model->validate())
				if ($model->resetPassword())
					return Yii::$app->user->identity->getAuthKey();

		return $model;
	}
}
