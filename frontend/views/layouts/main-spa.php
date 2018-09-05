<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use frontend\assets\AppAsset;

AppAsset::register($this);

$iconSignIn = Html::tag('i', null, [
	'class' => 'fa fa-sign-in'
]);

$iconUser = Html::tag('i', null, [
	'class' => 'fa fa-user'
]);

?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="bolhbe">
<head>
	<meta charset="<?= Yii::$app->charset ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="analytics" state="<?= Yii::$app->params['analytics']; ?>">
	<meta name="fragment" content="!" />
<?= Html::csrfMetaTags() ?>
	<title ng-bind="$title ? $title + ' &#8212; болх.бе' : 'Загрузка...'">Загрузка...</title>
	<link rel="alternate" hreflang="ru" href="https://bolh.be/" />
	<?php $this->head() ?>
</head>
<body ng-controller="bodyCtrl">
<?php $this->beginBody() ?>
	<div class="wrap">
		<?php
		NavBar::begin([
			'brandLabel' => 'болх.бе',
			'brandUrl' => null,
			'brandOptions' => [
				'ui-sref' => 'page>home',
				'ui-sref-active' => 'active',
				'id' => 'go-home',
				'test-mode' => Yii::$app->params['testMode']
			],
			'options' => [
				'class' => 'brand-navigation navbar-fixed-top Fixed',
				'ng-cloak' => true,
			],
		]); ?>

		<?= Nav::widget([
			'items' => [
				[
					'label' => 'Регистрация',
					'linkOptions' => [
						'ui-sref' => 'user>signup',
						'ng-class' => '{"active": $active == "signup"}',
						'class' => 'prevented-link'
					],
					'options' => [
						'ng-if' => '!user',
						'class' => 'hidden-xs',
					],
				], [
					'label' => $iconSignIn . Html::tag('span', 'Войти', ['class' =>'hidden-xs']),
					'linkOptions' => [
						'ui-sref' => 'user>login',
						'ui-sref-active' => 'active',
						'class' => 'prevented-link'
					],
					'options' => [
						'ng-if' => '!user',
						'class' => 'wrapper-gate-in',
					],
				], [
					'label' => $iconUser . Html::tag('span', '{{user.profile.name && user.profile.family ? user.profile.name +" "+ user.profile.family : user.profile.name || user.phone}}', ['class' => 'hidden-xs']),
					'linkOptions' => [
						'ui-sref' => 'user>menu',
						'ng-class' => '{"active": $active == "user"}',
						'class' => 'prevented-link'
					],
					'options' => [
						'ng-if' => 'user',
					],
				],
			],
			'options' => [
				'class' => 'navbar-nav navbar-right',
			],
			'encodeLabels' => false,
		]); ?>

		<?= Nav::widget([
			'items' => [
				[
					'label' => 'Резюме',
					'linkOptions' => [
						'ui-sref' => 'resume>list',
						'ng-class' => '{"active": $active == "resume"}'
					],
				], [
					'label' => 'Вакансии',
					'linkOptions' => [
						'ui-sref' => 'vacancy>list',
						'ng-class' => '{"active": $active == "vacancy"}'
					],
				], [
					'label' => 'Компании',
					'linkOptions' => [
						'ui-sref' => 'company>list',
						'ng-class' => '{"active": $active == "company"}'
					],
				],
			],
			'options' => [
				'class' => 'navbar-nav navbar-modules',
			],
		]); ?>
		<? NavBar::end() ?>

		<?= Html::tag('ui-view') ?>
	</div>

	<?= Html::tag('mmenu-sidebar', null); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
