<?php

namespace common\modules\vacancy\models;

use Yii;
use yii\web\ForbiddenHttpException;

class VacancySearch extends \yii\base\Model
{
	public $user;
	public $region;
	public $city;
	public $scope;
	public $experience;
	public $employment;

	public function rules()
	{
		return [
			[['user', 'region', 'city', 'scope', 'experience', 'employment'], 'number'],
		];
	}

	/**
	 * @return mixed
	 */
	public function querySearch()
	{
		$query = SearchModel::find([
				'!=', 'vacancy.status_id', SearchModel::STATUS_DELETED
			])
			->with([
				'region',
				'city',
				'scope',
				'experience',
				'employment',
			]);

		return $query;
	}

	/**
	 * @return array
	 */
	public function queryFilter()
	{
		$filters = [
			['=', 'vacancy.region_id', $this->region],
			['=', 'vacancy.city_id', $this->city],
			['=', 'vacancy.scope_id', $this->scope],
			['=', 'vacancy.experience_id', $this->experience],
			['=', 'vacancy.employment_id', $this->employment],
		];

		/**
		 * Перенести проверку в метод querySearch
		 */
		array_push($filters, $this->user ? 
			['=', 'vacancy.user_id', $this->getId()] :
			['=', 'vacancy.status_id', Vacancy::STATUS_ACTIVE]
		);

		return $filters;
	}

	/**
	 *
	 */
	public function configureFilters()
	{
		return [
			'region' => [],
			'city' => [],
			'scope' => [],
			'experience' => [],
			'employment' => [],
		];
	}

	public function getId()
	{
		$identity = \common\modules\user\models\User::findIdentityByHeader();

		if (!isset($identity)) throw new ForbiddenHttpException();

		return $identity->id;
	}
}

class SearchModel extends Vacancy
{
	public function fields()
	{
		return [
			'id',
			'position',
			'company_place',
			'region',
			'city',
			'user',
			'created_at',
		];
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getUser()
	{
		return parent::getUser()
			->one()
			->toArray([], [
				'company',
			]);
	}
}