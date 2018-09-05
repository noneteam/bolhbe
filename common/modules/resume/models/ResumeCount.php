<?php

namespace common\modules\resume\models;

/**
 * This is the model class for table "resume_count".
 *
 * @property integer $id
 * @property integer $view
 * @property integer $experience
 * @property integer $university
 * @property integer $course
 * @property integer $test
 * @property integer $language
 */
class ResumeCount extends \yii\db\ActiveRecord
{
	/**
	 * @inheritdoc
	 */
	public function fields()
	{
		return [
			'view',
			'experience',
			'university',
			'course',
			'test',
			'language',
		];
	}

	public function up($type)
	{
		$this->updateAttributes([$type => $this->$type + 1]);
	}

	public function down($type)
	{
		$this->updateAttributes([$type => $this->$type - 1]);
	}
}

