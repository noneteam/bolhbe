<?php

namespace common\modules\vacancy\models;

use common\components\validators\ProtectValidator;

/**
 * Vacancy prolong form
 *
 * Class VacancyProlong
 * @package common\modules\vacancy\models
 */
class VacancyProlong extends Vacancy
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	/**
	 * Main extra update action
	 * @return boolean
	 */
	public function defaultAction()
	{
		$this->updateAttributes([
			'expire_at' => time() + 30 * parent::TWENTY_FOUR_HOURS, // 30 days
			'status_id' => parent::STATUS_ACTIVE,
		]);

		return [
			'expire' => $this->expire,
			'status_id' => $this->status_id
		];
	}

	/**
	 * Vacancy load function
	 *
	 * @param $id
	 * @param array $loadParams
	 * @return parent 'loadModel' function
	 * @throws ForbiddenHttpException
	 * @throws GoneHttpException
	 * @throws NotFoundHttpException
	 */
	public static function loadModel($id, $loadParams = [])
	{
		return parent::loadModel($id, [
			'checkAuthor' => true,
			'checkExpired' => true
		]);
	}
}