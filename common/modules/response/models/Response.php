<?php

namespace common\modules\response\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "response_vacancy".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $resume_id
 * @property integer $vacancy_id
 * @property integer $show_phone_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $received_at
 * @property integer $returned_at
 * @property integer $received_back_at
 *
 * @property User $user
 * @property Resume $resume
 * @property Vacancy $vacancy
 */
class Response extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 5;
	const STATUS_CANCELED = 9;
	const STATUS_APPROVED = 10;

	public $protect;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%response_vacancy}}';
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}],
		];
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		$phoneNotProtected = Yii::$app->user->identity->status_id == User::STATUS_PHONE;

		if (($condition = !$model->hasErrors() && $phoneNotProtected) && $sync)
			new \common\models\MessageSms(Yii::$app->user->identity->phone);

		return $condition;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getResume()
	{
		return $this->hasOne(\common\modules\resume\models\Resume::className(), ['id' => 'resume_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getVacancy()
	{
		return $this->hasOne(\common\modules\vacancy\models\Vacancy::className(), ['id' => 'vacancy_id']);
	}

	/**
	 * @return string $created
	 */
	public function getCreated()
	{
		return Yii::$app->formatter->asDate($this->created_at, 'php:d F Y H:i');
	}

	/**
	 * @return string $responded
	 */
	public function getResponded()
	{
		return Yii::$app->formatter->asDate($this->responded_at, 'php:d F Y H:i');
	}

	/**
	 * Response load function
	 *
	 * @param $id
	 * @param array $loadParams
	 * @return mixed
	 * @throws ForbiddenHttpException
	 * @throws NotFoundHttpException
	 */
	public static function loadModel($id, $loadParams = [])
	{
		if (!$model = static::findOne($id))
			throw new NotFoundHttpException('Отклик не найден.');

		if (!in_array(Yii::$app->user->identity->id, [$model->vacancy->user->id, $model->resume->user_id]))
			throw new ForbiddenHttpException('Недостаточно привилегий.');

		if ($model->status_id == static::STATUS_DELETED)
			throw new NotFoundHttpException('Отклик удален одним из авторов.');

		if ($loadParams['checkAuthor'])
			if ($this->user->id != Yii::$app->user->identity->id)
				throw new ForbiddenHttpException('Доступ запрещен.');

		if ($loadParams['checkResponder'])
			if ($this->user->id == Yii::$app->user->identity->id)
				throw new ForbiddenHttpException('Ответ на свой отклик не возможен.');

		if ($loadParams['checkReturned'])
			if ($this->status_id != self::STATUS_ACTIVE)
				throw new ForbiddenHttpException('Повторный ответ на данный отклик не возможен.');

		return $model;
	}
}
