<?php

namespace common\modules\user\models;

use Yii;
use yii\web\UnauthorizedHttpException;
use common\modules\resume\models\Resume;
use common\modules\company\models\Company;

/**
 * User model
 *
 * @property integer $id
 * @property string $phone
 * @property string $password_hash
 * @property string $facebook_hash
 * @property string $password_reset_token
 * @property string $password_md5
 * @property string $auth_key
 * @property integer $status_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property LabelShowPhone $show_phone
 * @property UserProfile $profile
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
	const STATUS_PHONE = 5;
	const STATUS_DELETED = 0;
	const STATUS_ACTIVE = 10;

	const PATTERN_PHONE = '/^9[0-9]{9}+$/u'; //9123456789

	/**
	 * @inheritdoc
	 */
	public static function tableName()
	{
		return '{{%user}}';
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'id',
			'profile',
		];
	}

	/**
	 * @inheritdoc
	 */
	public function extraFields()
	{
		return [
			'resume',
			'company',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProfile()
	{
		return $this->hasOne(UserProfile::className(), ['id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompany()
	{
		return $this->hasOne(Company::className(), ['user_id' => 'id'])
			->andWhere(['company.status_id' => Company::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getResume()
	{
		return $this->hasOne(Resume::className(), ['user_id' => 'id'])
			->andWhere(['resume.status_id' => Resume::STATUS_ACTIVE]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getShow_phone() {
		return $this->hasOne(\common\models\LabelShowPhone::className(), ['id' => 'show_phone_id']);
	}

	/**
	 * @return string $created
	 */
	public function getCreated()
	{
		return Yii::$app->formatter->asDate($this->created_at, 'php:d M Y H:i:s');
	}

	/**
	 * @return string $updated
	 */
	public function getUpdated()
	{
		return Yii::$app->formatter->asDate($this->updated_at, 'php:d M Y H:i:s');
	}

	/**
	 * @return string mixed|$phone
	 */
	public function getPhone()
	{
		$placeholder = substr_replace($this->phone, '*****', -6, -1);

		switch($this->show_phone_id) {
			case 3: return $this->phone;
			case 2: return $this->findIdentityByHeader(false) ? $this->phone : $placeholder;
			case 1: return $placeholder;
		}
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentity($id)
	{
		return static::find()->where(['AND', ['id' => $id], ['!=', 'status_id', self::STATUS_DELETED]])->one();
	}

	/**
	 * @inheritdoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		return static::find()->where(['AND', ['auth_key' => $token], ['!=', 'status_id', self::STATUS_DELETED]])->one();
	}

	public static function findIdentityByHeader($showException = true)
	{
		if ($authorization = Yii::$app->request->headers->get('authorization'))
			$_explode = explode(' ', $authorization);

		if (isset($_explode[1]) && is_string($_explode[1]))
			return static::findIdentityByAccessToken($_explode[1]);

		if ($showException)
			throw new UnauthorizedHttpException();
	}

	/**
	 * Finds user by phone
	 *
	 * @param string $phone
	 * @return static|null
	 */
	public static function findByPhone($phone)
	{
		return static::find()->where(['AND', ['phone' => $phone], ['!=', 'status_id', self::STATUS_DELETED]])->one();
	}

	/**
	 * Finds user by facebook hash
	 *
	 * @param string $hash
	 * @return static|null
	 */
	public static function findByFacebookHash($hash)
	{
		return static::find()->where(['AND', ['facebook_hash' => $hash], ['!=', 'status_id', self::STATUS_DELETED]])->one();
	}

	/**
	 * Finds user by password reset token
	 *
	 * @param string $token password reset token
	 * @return static|null
	 */
	public static function findByPasswordResetToken($token)
	{
		if (!static::isPasswordResetTokenValid($token)) {
			return null;
		}

		return static::find()->where(['AND', ['password_reset_token' => $token], ['!=', 'status_id', self::STATUS_DELETED]])->one();
	}

	/**
	 * Finds out if password reset token is valid
	 *
	 * @param string $token password reset token
	 * @return bool
	 */
	public static function isPasswordResetTokenValid($token)
	{
		if (empty($token)) {
			return false;
		}

		$timestamp = (int) substr($token, strrpos($token, '_') + 1);
		$expire = Yii::$app->params['user.passwordResetTokenExpire'];
		return $timestamp + $expire >= time();
	}

	/**
	 * @inheritdoc
	 */
	public function getId()
	{
		return $this->getPrimaryKey();
	}

	/**
	 * @inheritdoc
	 */
	public function getAuthKey()
	{
		return $this->auth_key;
	}

	/**
	 * @inheritdoc
	 */
	public function validateAuthKey($authKey)
	{
		return $this->getAuthKey() === $authKey;
	}

	/**
	 * If isset old password removes it and validates password
	 *
	 * @param string $password password to validate
	 * @return bool if password provided is valid for current user
	 */
	public function validatePassword($password)
	{
		if ($this->password_md5)
			return md5($password) === $this->password_md5;

		return Yii::$app->security->validatePassword($password, $this->password_hash);
	}

	/**
	 * Generates password hash from password and sets it to the model
	 *
	 * @param string $password
	 */
	public function setPassword($password)
	{
		$this->password_hash = Yii::$app->security->generatePasswordHash($password);
	}

	/**
	 * Generates "remember me" authentication key
	 */
	public function generateAuthKey()
	{
		$this->auth_key = Yii::$app->security->generateRandomString();
	}

	/**
	 * Generates new password reset token
	 */
	public function generatePasswordResetToken()
	{
		$this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
	}

	/**
	 * Removes password reset token
	 */
	public function removePasswordResetToken()
	{
		$this->password_reset_token = null;
	}
}
