<?php

use yii\helpers\Html;

$positions = [];

if ($model->resume)
	foreach ($model->resume['positions'] as $key => $value)
		array_push($positions, $value['position']['text']);

$positions = implode(', ', $positions);

$name = "{$model->profile['name']} {$model->profile['family']}";

$this->title = $positions ? "$positions ($name)" : $name;

if ($model->resume) {

	$salary = $model->resume['salary'] ?: 0;
	$seniority = isset($model->resume['count']['seniority']['years']) ? $model->resume['count']['seniority']['years'] : 0;

	\Yii::$app->params['description'] = "{$model->resume['state']['text']}. Сфера деятельности: {$model->resume['scope']['text']}. Интересуемый оклад: $salary ₽. Опыт работы: $seniority год/лет.";
}
?>


<div itemscope itemtype="http://schema.org/Person">

	<?= $this->render('resume', [
		'model' => $model
	]); ?>

</div>

