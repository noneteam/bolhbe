<?php

namespace console\controllers;

use Yii;
use yii\helpers\Console;
use common\modules\vacancy\models\Vacancy;

class ExpireController extends \yii\console\Controller
{
	public function actionIndex()
	{
		$this->stdout('Marking expired vacancies' . PHP_EOL, Console::FG_GREY);

		Vacancy::updateAll(['status_id' => Vacancy::STATUS_EXPIRED], '[[expire_at]] > 0 AND [[expire_at]] < :now', [':now' => time()]);

		$this->stdout('Done!' . PHP_EOL, Console::FG_GREEN);
	}
}