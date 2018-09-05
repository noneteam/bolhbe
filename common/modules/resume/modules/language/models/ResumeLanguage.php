<?php

namespace common\modules\resume\modules\language\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "resume_language".
 *
 * @property integer $id
 * @property integer $resume_id
 * @property integer $language_id
 * @property integer $level_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property LabelLanguage $language
 * @property LabelLevel $level
 * @property Resume $resume
 */
class ResumeLanguage extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

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
				'module' => 'language'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%resume_language}}';
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
			'language',
			'level',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLanguage()
	{
		return $this->hasOne(\common\models\LabelLanguage::className(), ['id' => 'language_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLevel()
	{
		return $this->hasOne(\common\models\LabelLevel::className(), ['id' => 'level_id']);
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
	 * Load language model
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
