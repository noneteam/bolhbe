<?php

use yii\helpers\Html;

$worker = Html::tag('b', 'соискателя');

$employer = Html::tag('b', 'работодателя');

$freelancer = Html::tag('b', 'фрилансера');

?>

<?= Html::tag('h1', 'Нашел & Пригласил & Работаем!') ?>

<?= Html::tag('p', "Инструменты $worker, $employer, $freelancer помогающие объединяться.") ?>