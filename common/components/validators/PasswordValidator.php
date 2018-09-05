<?php

namespace common\components\validators;

class PasswordValidator extends \yii\validators\Validator
{
	public $user;

	public $message = 'Не верны «номер телефона» либо «пароль».';

	/**
	 * @param $model
	 * @param $attribute
	 */
	public function validateAttribute($model, $attribute)
	{
		if (!empty($this->validateValue($model->$attribute)))
			$this->addError($model, $attribute, $this->message);
	}

	/**
	 * @param $value
	 * @return bool
	 */
	protected function validateValue($value)
	{
		if (!$this->user || !$this->user->validatePassword($value))
			return true;
	}
}