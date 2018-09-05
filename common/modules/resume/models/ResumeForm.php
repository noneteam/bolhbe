<?php

namespace common\modules\resume\models;

use Yii;
use common\components\RelationHelper;
use common\components\validators\ProtectValidator;

/**
 * Resume create/update form
 *
 * Class ResumeForm
 * @package common\modules\resume\models
 */
class ResumeForm extends Resume
{
	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['salary', 'integer'],

			[['positions', 'employment', 'move', 'trip', 'time', 'scope'], 'required'],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if ($insert) $this->initResume();

		ResumePosition::sync($this->id, $this->positions);
	}

	public function fields()
	{
		return [
			'positions',
			'salary',
			'employment',
			'move',
			'scope',
			'state',
			'time',
			'trip',
		];
	}

	/**
	 * @param array $value
	 */
	public function setEmployment($value)
	{
		$this->employment_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setMove($value)
	{
		$this->move_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setScope($value)
	{
		$this->scope_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setTime($value)
	{
		$this->time_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setTrip($value)
	{
		$this->trip_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setPositions($value)
	{
		$this->positions = RelationHelper::setValues($value, 'position');
	}

	/**
	 * New resume content initialization
	 */
	public function initResume()
	{
		$model = new ResumeCount;
		$model->id = $this->id;
		$model->save(false);

		$role = Yii::$app->authManager->getRole('worker');
		Yii::$app->authManager->assign($role, Yii::$app->user->identity->id);
	}
}