<?php

namespace common\modules\vacancy\models;

/**
 * Vacancy delete form
 *
 * Class VacancyDelete
 * @package common\modules\vacancy\models
 */
class VacancyDelete extends Vacancy
{
	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		$context = new \ZMQContext();

		$socket = $context->getSocket(\ZMQ::SOCKET_PUSH);

		if($socket instanceof \ZMQSocket) {

			$socket->connect("tcp://127.0.0.1:5555");

			$socket->send(json_encode([
				'subscribeKey' => 'listMonitoring',
				'state' => 'vacancy'
			]));

		}

		return $this->updateAttributes([
			'status_id' => parent::STATUS_DELETED,
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		/**
		 * Обновление счетчика при удалении вакансии с компанией
		 */
		if ($this->user->company)
			$this->user->company->count->down('vacancy', $this);
	}
}