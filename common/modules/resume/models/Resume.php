<?php

namespace common\modules\resume\models;

use Yii;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;
use common\modules\resume\modules\test\models\ResumeTest;
use common\modules\resume\modules\course\models\ResumeCourse;
use common\modules\resume\modules\language\models\ResumeLanguage;
use common\modules\resume\modules\university\models\ResumeUniversity;
use common\modules\resume\modules\experience\models\ResumeExperience;

/**
 * This is the model class for table "resume".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $salary
 * @property integer $employment_id
 * @property integer $move_id
 * @property integer $trip_id
 * @property integer $time_id
 * @property integer $scope_id
 * @property integer $state_id
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property ResumeCount $count
 * @property LabelEmployment $employment
 * @property LabelMove $move
 * @property LabelScope $scope
 * @property LabelState $state
 * @property LabelTime $time
 * @property LabelTrip $trip
 */
class Resume extends \yii\db\ActiveRecord
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
			\common\behaviors\BlameableBehavior::className(),
			\common\behaviors\PhoneStatusBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%resume}}';
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'positions'
		];
	}

	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return [
			'id',
			'count' => function() {
				return array_merge($this->count->attributes, ['seniority' => $this->seniority]);
			},
			'salary',
			'employment',
			'move',
			'scope',
			'state',
			'time',
			'trip',

			'course',
			'experience',
			'language',
			'test',
			'university',
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
	public function getCount()
	{
		return $this->hasOne(ResumeCount::className(), ['id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getEmployment()
	{
		return $this->hasOne(\common\models\LabelEmployment::className(), ['id' => 'employment_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMove()
	{
		return $this->hasOne(\common\models\LabelMove::className(), ['id' => 'move_id']);
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
	public function getState()
	{
		return $this->hasOne(\common\models\LabelState::className(), ['id' => 'state_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTime()
	{
		return $this->hasOne(\common\models\LabelTime::className(), ['id' => 'time_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTrip()
	{
		return $this->hasOne(\common\models\LabelTrip::className(), ['id' => 'trip_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPositions()
	{
		return $this->hasMany(ResumePosition::className(), ['resume_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUniversity()
	{
		return $this->hasMany(ResumeUniversity::className(), ['resume_id' => 'id'])
			->andWhere(['resume_university.status_id' => ResumeUniversity::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getExperience()
	{
		return $this->hasMany(ResumeExperience::className(), ['resume_id' => 'id'])
			->andWhere(['resume_experience.status_id' => ResumeExperience::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getLanguage()
	{
		return $this->hasMany(ResumeLanguage::className(), ['resume_id' => 'id'])
			->andWhere(['resume_language.status_id' => ResumeLanguage::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCourse()
	{
		return $this->hasMany(ResumeCourse::className(), ['resume_id' => 'id'])
			->andWhere(['resume_course.status_id' => ResumeCourse::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getTest()
	{
		return $this->hasMany(ResumeTest::className(), ['resume_id' => 'id'])
			->andWhere(['resume_test.status_id' => ResumeTest::STATUS_ACTIVE]);
	}

	/**
	 * @return array of months and days of experience stage
	 */
	public function getSeniority()
	{
		$query = $this->getExperience()->select(['hired_at', 'dismissed_at']);

		$days = [];

		foreach ($query->asArray()->each() as $experience) {

			$begin = new \DateTime(date('Y-m', $experience['hired_at']));
			$end = new \DateTime($experience['dismissed_at'] ? date('Y-m', $experience['dismissed_at']) : date('Y-m'));

			$range = new \DatePeriod($begin, new \DateInterval('P1D'), $end);

			foreach ($range as $date)
				$days[$date->format('Ymd')] = true;
		}

		$interval = (new \DateTime())->diff((new \DateTime())->modify('-' . count($days) . ' day'));

		$result = [];

		if ($interval->y)
			$result['years'] = $interval->y;

		if ($interval->m)
			$result['months'] = $interval->m;

		return $result;
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
	 * Find resume by identity
	 *
	 * @return mixed
	 */
	public static function loadModel($id, $loadParams = [])
	{
		if (!$model = static::findOne(['user_id' => Yii::$app->user->identity->id, 'status_id' => static::STATUS_ACTIVE]))
			throw new NotFoundHttpException('У данного пользователя резюме не найдено.');

		return $model;
	}
}