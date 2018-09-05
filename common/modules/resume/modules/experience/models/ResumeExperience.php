<?php

namespace common\modules\resume\modules\experience\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "resume_experience".
 *
 * @property integer $id
 * @property integer $resume_id
 * @property integer $position_id
 * @property integer $place_id
 * @property integer $region_id
 * @property integer $scope_id
 * @property string $site
 * @property integer $hired_at
 * @property integer $hired
 * @property integer $dismissed_at
 * @property string $dismissed
 * @property string $content
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property CompanyPlace $place
 * @property VacancyPosition $position
 * @property LocationRegion $region
 * @property LabelScope $scope
 */
class ResumeExperience extends \yii\db\ActiveRecord
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
				'module' => 'experience'
			]
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%resume_experience}}';
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
			'position',
			'place',
			'site',
			'scope',
			'region',
			'content',
			'hired',
			'dismissed',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosition()
	{
		return $this->hasOne(\common\modules\vacancy\modules\position\models\VacancyPosition::className(), ['id' => 'position_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPlace()
	{
		return $this->hasOne(\common\modules\company\models\CompanyPlace::className(), ['id' => 'place_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getScope()
	{
		return $this->hasOne(\common\models\LabelScope::className(), ['id' => 'scope_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getRegion()
	{
		return $this->hasOne(\common\modules\location\models\LocationRegion::className(), ['id' => 'region_id']);
	}

	/**
	 * @return string $hired_at as data
	 */
	public function getHired()
	{
		return Yii::$app->formatter->asDate($this->hired_at, 'php:M Y');
	}

	/**
	 * @return string $dismissed_at as data
	 */
	public function getDismissed()
	{
		return $this->dismissed_at ? Yii::$app->formatter->asDate($this->dismissed_at, 'php:M Y') : null;
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
