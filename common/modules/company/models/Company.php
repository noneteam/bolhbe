<?php

namespace common\modules\company\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "company".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $title_id
 * @property string $content
 * @property string $phone
 * @property string $site
 * @property string $email
 * @property integer $scope_id
 * @property string $logotype
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property LabelScope $scope
 * @property CompanyPlace $title
 * @property CompanyCount $count
 */
class Company extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const PATTERN_PHONE = '/^[0-9]{10}+$/u'; //79123456789

	public $protect;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%company}}';
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
			'title'
		];
	}

	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return [
			'id',
			'count',
			'scope',
			'content',
			'site',
			'phone',
			'email',
			'logotype',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCount()
	{
		return $this->hasOne(CompanyCount::className(), ['id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTitle()
	{
		return $this->hasOne(CompanyPlace::className(), ['id' => 'title_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getScope()
	{
		return $this->hasOne(\common\models\LabelScope::className(), ['id' => 'scope_id']);
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
	 * Find comapny
	 *
	 * @return mixed
	 */
	public static function loadModel($id, $loadParams = [])
	{
		if (!$model = static::findOne(['user_id' => Yii::$app->user->identity->id, 'status_id' => static::STATUS_ACTIVE]))
			throw new NotFoundHttpException('У данного пользователя компания не найдена.');

		return $model;
	}
}