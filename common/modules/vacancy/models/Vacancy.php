<?php

namespace common\modules\vacancy\models;

use Yii;
use yii\web\GoneHttpException;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use common\modules\user\models\User;

/**
 * This is the model class for table "vacancy".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $company_place_id
 * @property integer $position_id
 * @property integer $salary
 * @property integer $experience_id
 * @property integer $employment_id
 * @property integer $scope_id
 * @property string $content
 * @property integer $region_id
 * @property integer $city_id
 * @property string $phone
 * @property integer $status_id
 * @property integer $expire_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property LocationRegion $region
 * @property LocationCity $city
 * @property CompanyPlace $companyPlace
 * @property LabelEmployment $employment
 * @property LabelExperience $experience
 * @property VacancyPosition $position
 * @property LabelScope $scope
 * @property User $user
 * @property date() $expire
 * @property date() $created
 * @property date() $updated
 */
class Vacancy extends \yii\db\ActiveRecord
{
	const STATUS_DELETED = 0;
	const STATUS_EXPIRED = 1;
	const STATUS_ACTIVE = 10;
	const STATUS_HIDDEN = 9;

	const TWENTY_FOUR_HOURS = 24 * 60 * 60;

	public $protect;

	public $old_company_place_id;

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%vacancy}}';
	}

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
	 * Turns on required for 'protect' field
	 * @return boolean $phoneNotProtected
	 */
	static function protectRequired($model, $sync=true)
	{
		$phoneNotProtected = Yii::$app->user->identity->status_id == User::STATUS_PHONE;

		if ($phoneNotProtected && $sync)
			new \common\models\MessageSms(Yii::$app->user->identity->phone);

		return $phoneNotProtected;
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'id',
			'user' => function() {
				return $this->user->toArray([], ['company']);
			},
			'position',
			'company_place',
			'salary',
			'experience',
			'employment',
			'scope',
			'region',
			'city',
			'content',
			'phone' => function() {
				return $this->phone ? : $this->user->getPhone();
			},
			'status_id',
			'expire',
			'created_at',
			'updated_at',
		];
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
	public function getRegion()
	{
		return $this->hasOne(\common\modules\location\models\LocationRegion::className(), ['id' => 'region_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCity()
	{
		return $this->hasOne(\common\modules\location\models\LocationCity::className(), ['id' => 'city_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompany_place()
	{
		return $this->hasOne(\common\modules\company\models\CompanyPlace::className(), ['id' => 'company_place_id']);
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
	public function getScope()
	{
		return $this->hasOne(\common\models\LabelScope::className(), ['id' => 'scope_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getExperience()
	{
		return $this->hasOne(\common\models\LabelExperience::className(), ['id' => 'experience_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getPosition()
	{
		return $this->hasOne(\common\modules\vacancy\modules\position\models\VacancyPosition::className(), ['id' => 'position_id']);
	}

	/**
	 * @return string $expire_at as data
	 */
	public function getExpire()
	{
		return $this->expire_at ? abs((int)(($this->expire_at - time())/60/60/24)) : null;
	}

	/**
	 * @return string $created_at as data
	 */
	public function getCreated()
	{
		return Yii::$app->formatter->asDate($this->created_at, 'php:d M Y');
	}

	/**
	 * @return string $updated_at as data
	 */
	public function getUpdated()
	{
		return Yii::$app->formatter->asDate($this->updated_at, 'php:d M Y');
	}

	/**
	 * Vacancy load function
	 *
	 * @param $id
	 * @param array $loadParams
	 * @return mixed
	 * @throws ForbiddenHttpException
	 * @throws GoneHttpException
	 * @throws NotFoundHttpException
	 */
	public static function loadModel($id, $loadParams = [])
	{
		if (!$model = static::findOne(['id' => $id]))
			throw new NotFoundHttpException('Вакансия с таким ID не найдена.');

		if ($model->status_id == self::STATUS_DELETED)
			throw new GoneHttpException('Вакансия удалена автором.');

		switch (isset($loadParams['checkAuthor'])) {
			case true:

				if ($model->user_id != Yii::$app->user->identity->id)
					throw new ForbiddenHttpException('Нет авторских привилегий.');

				if (isset($loadParams['checkShown']) && $model->status_id == self::STATUS_HIDDEN)
					throw new ForbiddenHttpException();

				if (isset($loadParams['checkHidden']) && $model->status_id != self::STATUS_HIDDEN)
					throw new ForbiddenHttpException();

				if (isset($loadParams['checkExpired']) && $model->status_id != self::STATUS_EXPIRED)
					throw new ForbiddenHttpException('Вакансия не является истекшей');

				break;

			case false:

				if (in_array($model->status_id, [self::STATUS_EXPIRED, self::STATUS_HIDDEN])) {

					$identity = User::findIdentityByHeader(false);

					if (!isset($identity) || $identity->id != $model->user->id) {

						if ($model->status_id == self::STATUS_EXPIRED)
							throw new GoneHttpException('{"position": {"text": "' . $model->position->text . '"}, "expired": ' . $model->expire . '}');

						if ($model->status_id == self::STATUS_HIDDEN)
							throw new GoneHttpException('Вакансия закрыта автором.');

					}

				}

				break;

		}

		return $model;
	}
}
