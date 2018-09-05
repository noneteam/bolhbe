<?php

use yii\helpers\Html;

?>

<?= Html::tag('h3', Html::a($model->position->text, ['vacancy/view', 'id' => $model->id])); ?>