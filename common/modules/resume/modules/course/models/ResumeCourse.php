<?php

namespace common\modules\resume\modules\course\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "resume_course".
 *
 * @property integer $id
 * @property integer $resume_id
 * @property string $text
 * @property integer $company_place_id
 * @property integer $certificate_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property LabelCertificate $certificate
 * @property CompanyPlace $companyPlace
 * @property Resume $resume
 */
class ResumeCourse extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const PATTERN_RUSLATNUMSYM = '/^[а-яА-ЯёЁa-zA-Z0-9\+\-\=\_\ (\)\"«\»#\@\№\$\&\?\:\;\.\,]+$/u';

	public $protect;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\behaviors\PhoneStatusBehavior::className(),
			[
				'class' => \common\behaviors\ResumeModuleBehavior::className(),
				'module' => 'course'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%resume_course}}';
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
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'id',
			'text',
			'company_place',
			'certificate',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCertificate()
	{
		return $this->hasOne(\common\models\LabelCertificate::className(), ['id' => 'certificate_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompany_place()
	{
		return $this->hasOne(\common\modules\company\models\CompanyPlace::className(), ['id' => 'company_place_id']);
	}

	/**
	 * @return string $created
	 */
	public function getCreated()
	{
		return Yii::$app->formatter->asDate($this->created_at, 'php:d F Y H:i');
	}

	/**
	 * @return string $updated
	 */
	public function getUpdated()
	{
		return Yii::$app->formatter->asDate($this->updated_at, 'php:d F Y H:i');
	}

	/**
	 * Load course model
	 *
	 * @param $id
	 * @return mixed
	 * @throws ForbiddenHttpException
	 * @throws NotFoundHttpException
	 */
	public static function loadModel($id)
	{
		if (!$model = static::findOne(['id' => $id, 'status_id' => static::STATUS_ACTIVE]))
			throw new NotFoundHttpException('Запись с таким ID не найдена.');

		if ($model->resume_id != Yii::$app->user->identity->resume->id)
			throw new ForbiddenHttpException('Нет авторских привилегий.');

		return $model;
	}
}
