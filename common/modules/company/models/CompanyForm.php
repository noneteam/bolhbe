<?php

namespace common\modules\company\models;

use Yii;
use common\components\RelationHelper;
use common\components\validators\ProtectValidator;
use common\components\validators\HtmlPrepareFilter;

/**
 * Company create/update form
 *
 * Class CompanyForm
 * @package common\modules\company\models
 */
class CompanyForm extends Company
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [
			\yii\behaviors\TimestampBehavior::className(),
			\common\behaviors\BlameableBehavior::className(),
			\common\behaviors\PhoneStatusBehavior::className(),
		];
	}

	/**
	 * @inheritdoc
	 */
	public function rules()
	{
		return [
			['content', 'string', 'max' => '3000'],
			['content', HtmlPrepareFilter::className()],

			['email', 'string', 'max' => 64],
			['email', 'email'],

			['phone', 'match', 'pattern' => parent::PATTERN_PHONE],

			['site', 'url', 'defaultScheme' => 'http'],

			[['title', 'content', 'scope'], 'required'],

			['protect', ProtectValidator::className(), 'when' => function($model) {
				return parent::protectRequired($model, false);
			}],
			['protect', 'required', 'when' => function($model) {
				return parent::protectRequired($model);
			}]
		];
	}

	public function fields()
	{
		return [
			'title',
			'content',
			'scope',
			'site',
			'phone',
			'email'
		];
	}

	public function afterSave($insert, $changedAttributes)
	{
		parent::afterSave($insert, $changedAttributes);

		if ($insert) $this->initCompany();
	}

	/**
	 * @param array $value
	 */
	public function setTitle($value)
	{
		$this->title_id = RelationHelper::setValue($value);
	}

	/**
	 * @param array $value
	 */
	public function setScope($value)
	{
		$this->scope_id = RelationHelper::setValue($value);
	}

	/**
	 * New company content initialization
	 */
	public function initCompany()
	{
		$model = new CompanyCount;
		$model->id = $this->id;
		$model->save(false);

		$role = Yii::$app->authManager->getRole('employer');
		Yii::$app->authManager->assign($role, Yii::$app->user->identity->id);
	}
}