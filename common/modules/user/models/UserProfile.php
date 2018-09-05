<?php

namespace common\modules\user\models;

use Yii;

/**
 * This is the model class for table "user_profile".
 *
 * @property integer $id
 * @property string $name
 * @property string $family
 * @property integer $sex_id
 * @property integer $birthday_stamp
 * @property integer $region_id
 * @property integer $city_id
 * @property string $facebookcom
 * @property string $youtubecom
 * @property string $twittercom
 * @property string $vkcom
 * @property string $okru
 * @property string $skype
 * @property string $email
 * @property string $photo
 * @property integer $age
 *
 * @property LocationCity $city
 * @property LocationRegion $region
 * @property LabelSex $sex
 */
class UserProfile extends \yii\db\ActiveRecord
{
	const PATTERN_RUS = '/^[а-яА-ЯёЁ\-\ ]+$/u';

	const PATTERN_FACEBOOKCOM = '/^[a-z\d.]{5,}$/i';
	const PATTERN_YOUTUBECOM = '/^[a-zA-Z0-9]{1,}';
	const PATTERN_TWITTERCOM = '/^[A-Za-z0-9_]{1,15}$/';
	const PATTERN_VKCOM = '/^[A-Za-z0-9_]{5,32}$/';
	const PATTERN_OKRU = '/^[A-Za-z0-9_]{5,32}$/';
	const PATTERN_SKYPE = '/^[a-zA-Z][a-zA-Z0-9\.,\-_]{5,31}$/';

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user_profile}}';
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'name',
			'family',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return [
			'region',
			'city',
			'sex',
			'age',
			'birthday',
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
	public function getSex()
	{
		return $this->hasOne(\common\models\LabelSex::className(), ['id' => 'sex_id']);
	}

	/**
	 * @return string $birthday
	 */
	public function getBirthday()
	{
		return Yii::$app->formatter->asDate($this->birthday_stamp, 'php:Y-m-d');
	}

	/**
	 * @return int $age;
	 */
	public function getAge()
	{
		$age = 0;

		if ($birthday_stamp = $this->birthday_stamp)
			while(time() > $birthday_stamp = strtotime('+1 year', $birthday_stamp)) ++$age;

		return $age;
	}

	/**
	 * Find profile by identity
	 *
	 * @return mixed
	 */
	public static function loadModel()
	{
		return static::findOne(Yii::$app->user->id);
	}
}
