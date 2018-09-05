<?php

namespace common\modules\company\models;

use Yii;

/**
 * Company delete form
 *
 * Class CompanyDelete
 * @package common\modules\company\models
 */
class CompanyDelete extends Company
{
	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		if ($this->updateAttributes(['status_id' => parent::STATUS_DELETED])) {
			/**
			 * Удаляю роль 'работадатель' для пользователя
			 */
			$userRole = Yii::$app->authManager->getRole('employer');
			Yii::$app->authManager->revoke($userRole, Yii::$app->user->identity->id);

			/**
			 * Обнуляю счетчики компании и
			 * выставляю для всех дочерних вакансий
			 * название компании родное для этой компании
			 */
			$this->count->updateAttributes(['vacancy' => '0']);
			\common\modules\vacancy\models\Vacancy::updateAll(['company_place_id' => $this->title->id], [
				'user_id' => Yii::$app->user->identity->id,
				'company_place_id' => null
			]);
		}
	}
}