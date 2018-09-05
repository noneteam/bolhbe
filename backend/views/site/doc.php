<?php

/* @var $this yii\web\View */

$this->title = 'API Интерфейс';

?>

<style>
h1 {
	text-align: center;
	margin-bottom: 30px;
}
h3 {
	margin-top: 0;
}
body {
	color: #72848c;
}
url {
	color: #1fb36b;
}
pre {
	color: #999;
	border: none;
	padding: 15px 25px;
	tab-size: 5;
	font-size: 15px;
}
pre b {
	color: #b73333;
	font-weight: 100;
}
pre i, pre small {
	color: #ddd;
}
pre verb {
	color: #444;
}
pre:hover small {
	color: #aaa;
}
</style>

<?= $this->render('_user') ?>
<?= $this->render('_label') ?>
<?= $this->render('_location') ?>
<?= $this->render('_vacancy') ?>
<?= $this->render('_company') ?>
<?= $this->render('_resume') ?>
