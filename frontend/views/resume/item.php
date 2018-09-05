<?php

use yii\helpers\Html;

$positions = [];

foreach ($model->positions as $key => $value)
    array_push($positions, $value['position']['text']);

$positions = implode(', ', $positions);

?>

<?= Html::tag('h3', Html::a($positions, ['user/view', 'id' => $model->user->id])) ?>