<?php

namespace common\components\validators;

use Yii;

class ProtectValidator extends \yii\validators\Validator
{
	public $message = 'Не верный код протекции.';

	/**
	 * @return string $phone;
	 */
	protected function getPhone()
	{
		if ($phone = Yii::$app->request->post('phone'))
			return $phone;

		if ($identity = Yii::$app->user->identity)
			return $identity->phone;

		return null;
	}

	/**
	 * @param $model
	 * @param $attribute
	 */
	public function validateAttribute($model, $attribute)
	{
		if (!$this->phone)
			return $this->addError($model, $attribute, 'Не верно задан телефон.');

		if ($this->validateValue($model->$attribute))
			$this->addError($model, $attribute, $this->message);
	}

	/**
	 * @param $value
	 * @return boolean
	 */
	protected function validateValue($value)
	{
		$mesage = new \common\models\MessageSms($this->phone);
		
		return $mesage->get->text != $value;
	}
}