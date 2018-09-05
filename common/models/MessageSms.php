<?php

namespace common\models;

use Yii;

class MessageSms extends \yii\db\ActiveRecord
{
	const TIME_OUT = 10;

	/**
	 * @inheritdoc
	 */
	public function __construct($phone=null)
	{
		$this->phone = $phone;

		if (!$this->get || (int)((time() - $this->get->created_at) / 60) >= self::TIME_OUT)
			if ($this->validate() && $this->save())
				Yii::$app->sms->sms_send($phone, "{$this->text} - Ваша протекция");
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
	public function rules() {
		return [
			['text', 'default', 'value' => rand(99999, 999999)],
			['phone', 'match', 'pattern' => \common\modules\user\models\User::PATTERN_PHONE],
			['phone', 'required'],
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getGet()
	{
		return self::find()
			->where(['phone' => $this->phone])
			->orderBy(['created_at' => SORT_DESC])
			->one();
	}
}