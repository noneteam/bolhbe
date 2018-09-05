<?php

namespace common\modules\vacancy\models;

use Yii;
use common\modules\user\models\User;
use common\components\validators\ProtectValidator;
use common\components\validators\HtmlPrepareFilter;
use common\components\RelationHelper;

/**
 * Vacancy update form
 *
 * Class VacancyUpdateForm
 * @property User $user
 * @package common\modules\vacancy\models
 */
class VacancyForm extends Vacancy
{
	public $guest = false;
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['salary', 'integer', 'min' => 1],

			['phone', 'match', 'pattern' => User::PATTERN_PHONE],

			['content', 'string', 'max' => '3000'],
			['content', HtmlPrepareFilter::className()],

			['company_place', 'required', 'when' => function () {
				return empty(Yii::$app->user->identity->company);
			}],

			['phone', 'required', 'when' => function () {
				return $this->guest || !Yii::$app->user->identity->phone;
			}],

			[['position', 'content', 'scope', 'experience', 'employment', 'region', 'city'], 'required'],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return static::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return static::protectRequired($model);
			}],
		];
	}

	/**
	 * Turns on required for 'protect' field
	 * @return boolean $condition
	 */
	static function protectRequired($model, $sync=true)
	{
		$phoneNotMy = $model->phone && !in_array($model->phone, [
			$model->getOldAttribute('phone'),
			Yii::$app->user->identity->phone,
		]);

		if (($condition = !$model->hasErrors() && $phoneNotMy) && $sync)
			new \common\models\MessageSms($model->phone = $model->phone ?: Yii::$app->user->identity->phone);

		return $condition;
	}

	/**
	 * @inheritdoc
	 */
	public function beforeValidate()
	{
		/**
		 * Обознчение переменной для дальнейшего управления счетчиком компании
		 */
		$this->old_company_place_id = $this->getOldAttribute('company_place_id');

		return parent::beforeValidate();
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		if ($this->phone == '' || $this->phone == Yii::$app->user->identity->phone)
			$this->updateAttributes(['phone' => null]);

		if (Yii::$app->user->identity->company &&
			$this->company_place_id &&
			$this->company_place_id == Yii::$app->user->identity->company->title_id) {

			$this->updateAttributes(['company_place_id' => null]);
		}

		/**
		 * Обновление счетчика при добавлении вакансии с компанией
		 */
		if (Yii::$app->user->identity->company) {

			Yii::$app->user->identity->company->count->up('vacancy', $this);
			Yii::$app->user->identity->company->count->down('vacancy', $this);

		}

		parent::afterSave($insert, $changedAttributes);
	}

	/**
	 * @param array $value
	 */
	public function setPosition($value)
	{
		$this->position_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setRegion($value)
	{
		$this->region_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setCity($value)
	{
		$this->city_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setCompany_place($value)
	{
		$this->company_place_id = RelationHelper::setValue($value);
	}

	/**
	 * @param $value
	 */
	public function setEmployment($value)
	{
		$this->employment_id = RelationHelper::setValue($value);
	}

	/**
	 * @param $value
	 */
	public function setExperience($value)
	{
		$this->experience_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setScope($value)
	{
		$this->scope_id = RelationHelper::setValue($value);
	}

	/**
	 * @param integer $days
	 */
	public function setExpire($days)
	{
		$this->expire_at = time() + $days * parent::TWENTY_FOUR_HOURS;
	}
}