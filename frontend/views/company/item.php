<?php

use yii\helpers\Html;

?>

<?= Html::tag('h3', Html::a($model->title->text, ['user/view', 'id' => $model->user->id])) ?>