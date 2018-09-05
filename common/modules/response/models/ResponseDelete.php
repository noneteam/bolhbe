<?php

namespace common\modules\response\models;

/**
 * Response delete model
 *
 * Class ResponseDelete
 * @package common\modules\response\models
 */
class ResponseDelete extends Response
{
	/**
	 * Main pseudo delete action
	 * @return boolean
	 */
	public function defaultAction()
	{
		$this->updateAttributes([
			'status_id' => parent::STATUS_DELETED
		]);
	}

	/**
	 * @return parent::loadModel()
	 */
	public static function loadModel($id, $loadParams = [])
	{
		return parent::loadModel($id, [
			'checkAuthor' => true
		]);
	}
}