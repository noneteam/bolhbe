<?php

namespace common\components;

class Facebook extends \yii\authclient\clients\Facebook
{
	/**
	 * Extend standart facebook api call
	 * 
	 * @inheritdoc
	 */
	protected function initUserAttributes()
	{
		return $this->api('me', 'GET', [
			'fields' => implode(',', $this->attributeNames),
			'locale' => 'ru_RU'
		]);
	}
}