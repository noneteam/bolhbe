<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="<?= Yii::$app->charset ?>">
	<title><?= Html::encode($this->title ?: 'Вакансии в Грозном, работа в Ингушетии') ?> &#8212; болх.бе</title>

	<meta property="og:site_name" content="болх.бе" />
	<meta property="og:type" content="website" />
	<meta property="og:image" content="/images/og-image.gif" />
	<meta property="og:description" content="<?= Yii::$app->params['description']; ?>" />

	<link rel="alternate" hreflang="ru" href="https://bolh.be/" />
</head>
<body>
<?php $this->beginBody() ?>

	<?= html::tag('h1', Html::a('болх.бе', Yii::$app->homeUrl)) ?>

	<ul>
		<li><?= Html::a('Резюме', '/resume') ?></li>
		<li><?= Html::a('Вакансии', '/vacancy') ?></li>
		<li><?= Html::a('Компании', '/company') ?></li>
		<li><?= Html::a('Зарегистрироваться', '/signup') ?></li>
		<li><?= Html::a('Войти на сайт', '/login') ?></li>
	</ul>

	<?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
