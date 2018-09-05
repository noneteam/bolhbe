<?php

namespace common\modules\vacancy\models;

use Yii;
use common\modules\user\models\User;
use common\modules\user\models\SignupForm;
use yii\helpers\ArrayHelper;

/**
 * Vacancy create form
 *
 * Class VacancyCreateForm
 * @package common\modules\vacancy\models
 */
class VacancyFormExtra extends VacancyForm
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\behaviors\BlameableBehavior::className(),
			\common\behaviors\PhoneStatusBehavior::className(),
		];
	}

	public function init()
	{
		/**
		 * Поиск пользователя по авторизации
		 */
		if (!$model = User::findIdentityByHeader(false)) {

			$this->guest = true;

			if ($phone = Yii::$app->request->post('phone')) {

				/**
				 * Поиск пользователя по телефону из формы
				 */
				if (!$model = User::findByPhone($phone)) {

					/**
					 * Последняя попытка - регистрания нового пользователя
					 */
					$model = new SignupForm;

					$model->load(Yii::$app->request->post(), '');

					$model->defaultAction(false);

				}

			}

		}

		if (!$model)
			$model = User::findOne(1);

		Yii::$app->user->login($model);
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array_merge([
			['phone', 'required', 'when' => function () {
				return $this->guest || !Yii::$app->user->identity->phone;
			}],
		], parent::rules());
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		$phoneNotProtected = Yii::$app->user->identity->status_id == User::STATUS_PHONE;

		$phoneNotMy = $model->phone && $model->phone != Yii::$app->user->identity->phone;

		if (($condition = !$model->hasErrors() && ($model->guest || $phoneNotProtected || $phoneNotMy)) && $sync)
			new \common\models\MessageSms($model->phone ? : Yii::$app->user->identity->phone);

		return $condition;
	}

	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{

		$this->expire = $this->guest ? 14 : 30; // days

		$context = new \ZMQContext();

		$socket = $context->getSocket(\ZMQ::SOCKET_PUSH);

		if($socket instanceof \ZMQSocket) {

			$socket->connect("tcp://127.0.0.1:5555");

			$socket->send(json_encode([
				'subscribeKey' => 'listMonitoring',
				'state' => 'vacancy'
			]));

		}

		return $this->save(false);

	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		/**
		 * Обновление счетчика при добавлении вакансии с компанией
		 */
		if (Yii::$app->user->identity->company)
			Yii::$app->user->identity->company->count->up('vacancy', $this);
	}
}