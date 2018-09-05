<?php

namespace common\modules\response\models;

/**
 * Response return model
 *
 * Class ResponseReturn
 * @package common\modules\response\models
 */
class ResponseReturn extends Response
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return array_merge([
			['status_id', 'required'],

			['status_id', 'in', 'range' => [parent::STATUS_CANCELED, parent::STATUS_APPROVED]],
		], parent::rules());
	}

	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		$this->updateAttributes([
			'responded_at' => time(),
			'status_id' => $this->status_id
		]);
	}

	public static function loadModel($id, $loadParams = [])
	{
		return parent::loadModel($id, [
			'checkResponder' => true,
			'checkReturned' => true,
		]);
	}
}