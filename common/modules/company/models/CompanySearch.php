<?php

namespace common\modules\company\models;

use common\modules\user\models\User;

/**
 * List users with active company
 *
 * Class ResumeSearch
 * @package common\modules\company\models
 */
class CompanySearch extends \yii\base\Model
{
	public $region;
	public $city;
	public $scope;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['region', 'city', 'scope'], 'number'],
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		return SearchModel::find()
			->where([
				'AND',
				['!=', 'user.status_id', User::STATUS_DELETED],
				['company.status_id' => Company::STATUS_ACTIVE]
			])
			->joinWith([
				'user',
				'scope',
			]);
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		return [
			['=', 'user_profile.region_id', $this->region],
			['=', 'user_profile.city_id', $this->city],
			['=', 'company.scope_id', $this->scope],
		];
	}

	/**
	 *
	 */
	public function configureFilters()
	{
		return [
			'region' => [
				'relative' => 'profile.',
				'prefix' => 'user_',
			],
			'city' => [
				'relative' => 'profile.',
				'prefix' => 'user_',
			],
			'scope' => [],
		];
	}
}

class SearchModel extends Company
{
	public function fields()
	{
		return [
			'user' => function() {
				return [
					'id' => $this->profile->id,
					'profile' =>$this->profile->toArray([], [
						'city',
					])
				];
			},
			'title',
			'count',
			'created_at',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCount()
	{
		return parent::getCount()
			->select([
				'vacancy',
			])
			->asArray();
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id'])
			->joinWith(['profile']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProfile()
	{
		return $this->hasOne(\common\modules\user\models\UserProfile::className(), ['id' => 'user_id']);
	}
}