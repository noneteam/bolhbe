<?php

namespace common\modules\resume\models;

use common\modules\user\models\User;
use common\modules\user\models\UserProfile;

/**
 * List users with active resume
 *
 * Class ResumeSearch
 * @package backend\modules\resume\models
 */
class ResumeSearch extends \yii\base\Model
{
	public $region;
	public $city;
	public $sex;
	public $scope;
	public $employment;
	public $state;

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			[['region', 'city', 'sex', 'scope', 'employment', 'state'], 'number'],
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
				['resume.status_id' => Resume::STATUS_ACTIVE]
			])
			->joinWith([
				'user',
				'profile',
				'scope',
				'employment',
				'state',
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
			['=', 'user_profile.sex_id', $this->sex],
			['=', 'resume.scope_id', $this->scope],
			['=', 'resume.employment_id', $this->employment],
			['=', 'resume.state_id', $this->state],
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
			'employment' => [],
			'state' => [],
			'sex' => [
				'relative' => 'profile.',
				'prefix' => 'user_',
			],
		];
	}
}

class SearchModel extends Resume
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
			'positions',
			'count',
			'created_at',
			'status_id',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getCount()
	{
		return parent::getCount()
			->select([
				'experience',
				'university',
			])
			->asArray();
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return $this->hasOne(User::className(), ['id' => 'user_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProfile()
	{
		return $this->hasOne(UserProfile::className(), ['id' => 'user_id']);
	}
}