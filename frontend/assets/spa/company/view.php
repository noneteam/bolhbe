<?php

use yii\helpers\Html;


$iconYoutube = Html::tag('i', null, [
	'class' => 'fa fa-youtube'
]);

$iconFacebook = Html::tag('i', null, [
	'class' => 'fa fa-facebook'
]);

$iconVk = Html::tag('i', null, [
	'class' => 'fa fa-vk'
]);

$iconOdnoklassniki = Html::tag('i', null, [
	'class' => 'fa fa-odnoklassniki'
]);

$iconTwitter = Html::tag('i', null, [
	'class' => 'fa fa-twitter'
]);

$iconSkype = Html::tag('i', null, [
	'class' => 'fa fa-skype'
]);

$labels = [
	'add' => Html::tag('i', null, [
		'class' => 'fa fa-plus',
	]) . ' Добавить',

	'edit' => Html::tag('i', null, [
		'class' => 'fa fa-sliders',
	]) . Html::tag('span', 'Настроить', [
		'class' => 'hidden-xs'
	])
];

$linkCompanySettings = Html::button($labels['edit'], [
	'ui-sref' => 'company>form',
	'ui-sref-active' => 'active',
	'class' => 'prevented-link pull-right btn-link',
	'ng-if' => 'user.id === content.id',
]);

?>

<div class="view-company">

	<?= Html::tag('header', $this->render('view-header')) ?>

	<div class="container" style="margin-top: 30px">

		<div class="row">

			
			<div class="col-md-9">
				<?= Html::tag('div', null, [
					'ng-bind-html' => 'content.company.content',
					'class' => '',
				]); ?>

				<?= $linkCompanySettings ?>

			</div>

			<div class="col-md-3">

				<p>
					<b>{{content.profile.name}} {{content.profile.family}}</b>
				</p>

				<h4>
					<?= Html::a('{{content.phone|phone}}', 'tel: +7{{content.phone}}', [
						'title' => '{{content.show_phone.text}}'
					]) ?>
				</h4>

				<p>
					<?= Html::a($iconYoutube, null, [
						'ng-href' => '{{content.profile.youtubecom ? "http://www.youtube.com/user/" + content.profile.youtubecom : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>

					<?= Html::a($iconFacebook, null, [
						'ng-href' => '{{content.profile.facebookcom ? "http://www.facebook.com/" + content.profile.facebookcom : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>

					<?= Html::a($iconVk, null, [
						'ng-class' => '{{content.profile.vkcom ? "http://vk.com/" + content.profile.vkcom : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>

					<?= Html::a($iconOdnoklassniki, null, [
						'ng-href' => '{{content.profile.okru ? "http://ok.ru/profile/" + content.profile.okru : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>

					<?= Html::a($iconTwitter, null, [
						'ng-href' => '{{content.profile.twittercom ? "http://twitter.com/" + content.profile.twittercom : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>

					<?= Html::a($iconSkype, null, [
						'ng-href' => '{{content.profile.skype ? "skype:live:" + content.profile.skype : null}}',
						'target' => '_blank',
						'class' => 'btn btn-default',
					]); ?>
				</p>

			</div>

		</div>
	</div>

</div>