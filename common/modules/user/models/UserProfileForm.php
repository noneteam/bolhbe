<?php

namespace common\modules\user\models;

use Yii;
use common\components\RelationHelper;
use common\components\validators\ProtectValidator;
use common\components\validators\TextPrepareFilter;

/**
 * Profile update form
 *
 * @package common\modules\user\models
 */
class UserProfileForm extends UserProfile
{
	public $protect;

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\common\behaviors\PhoneStatusBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['name', 'family'], 'match', 'pattern' => parent::PATTERN_RUS],
			[['name', 'family'], 'string', 'min' => 2, 'max' => 32],
			[['name', 'family'], TextPrepareFilter::className()],

			['email', 'string', 'max' => 64],
			['email', 'email'],

			['birthday', 'date', 'format' => 'php:Y-m-d'],

			['facebookcom', 'match', 'pattern' => parent::PATTERN_FACEBOOKCOM],
			['youtubecom', 'match', 'pattern' => parent::PATTERN_YOUTUBECOM],
			['twittercom', 'match', 'pattern' => parent::PATTERN_TWITTERCOM],
			['vkcom', 'match', 'pattern' => parent::PATTERN_VKCOM],
			['okru', 'match', 'pattern' => parent::PATTERN_OKRU],
			['skype', 'match', 'pattern' => parent::PATTERN_SKYPE],

			[['facebookcom', 'youtubecom', 'twittercom', 'vkcom', 'okru', 'skype'], 'string', 'max' => 255],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return self::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return self::protectRequired($model);
			}],

			[['name', 'family', 'sex', 'birthday', 'region', 'city'], 'required'],
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
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'name',
			'family',
			'sex',
			'birthday',
			'age',
			'region',
			'city',
			'facebookcom',
			'youtubecom',
			'twittercom',
			'vkcom',
			'okru',
			'skype',
			'email',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if (!Yii::$app->user->can('user') && Yii::$app->user->identity->phone) {

			$userRole = Yii::$app->authManager->getRole('user');
			Yii::$app->authManager->assign($userRole, Yii::$app->user->id);

		}
	}

	/**
	 * @param array $value
	 */
	public function setSex($value)
	{
		$this->sex_id = RelationHelper::setValue($value);
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
	 * @param string $value
	 */
	public function setBirthday($value)
	{
		$this->birthday = $value;
		$this->birthday_stamp = strtotime($value);
	}
}