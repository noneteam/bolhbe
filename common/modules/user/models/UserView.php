<?php

namespace common\modules\user\models;

use yii\web\NotFoundHttpException;

class UserView extends User
{
	public function fields()
	{
		return [
			'id',
			'phone' => function() {
				return $this->getPhone();
			},
			'show_phone',
			'roles',
			'profile',
			'company',
			'resume',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProfile()
	{
		// нужно писать логи если профиля нет
		return parent::getProfile()
			->one()
			->toArray([], [
				'region',
				'city',
				'sex',
				'birthday',
				'age',
				'facebookcom',
				'youtubecom',
				'twittercom',
				'vkcom',
				'okru',
				'skype',
				'email',
			]);
	}

	/**
	 * @return array
	 */
	public function getRoles()
	{
		$model = AuthAssignment::find()
			->where(['user_id' => $this->id])
			->asArray()
			->all();

		$output = [];

		foreach ($model as $key => $value) {
			array_push($output, $value['item_name']);
		}

		return $output;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCompany()
	{
		$relation = parent::getCompany()
			->one();

		return $relation ? $relation
			->toArray([], [
				'id',
				'count',
				'scope',
				'content',
				'site',
				'phone',
				'email',
				'logotype',
			]) : null;
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getResume()
	{
		$relation = parent::getResume()
			->one();

		return $relation ? $relation
			->toArray([], [
				'id',
				'count',
				'salary',
				'employment',
				'move',
				'scope',
				'state',
				'time',
				'trip',

				'experience',
				'university',
				'course',
				'language',
				'test',
			]) : null;
	}

	public static function loadModel($id)
	{
		if (!$model = $id != 0 ? static::findIdentity($id) : static::findIdentityByHeader())
			throw new NotFoundHttpException();

		return $model;
	}
}