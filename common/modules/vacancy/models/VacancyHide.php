<?php

namespace common\modules\vacancy\models;

use common\components\validators\ProtectValidator;

/**
 * Vacancy hide form
 *
 * Class VacancyHide
 * @package common\modules\vacancy\models
 */
class VacancyHide extends Vacancy
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
		$this->updateAttributes(['status_id' => parent::STATUS_HIDDEN]);

		return [
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
			'checkShown' => true
		]);
	}
}