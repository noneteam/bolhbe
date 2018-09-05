<?php

use yii\helpers\Html;

$linkResumeScope = Html::a('{{content.resume.scope.text}}', null, [
	'ui-sref' => 'resume>list({scope: content.resume.scope.id})',
]);

$linkProfileRegion = Html::a('{{content.profile.region.text}}', null, [
	'ui-sref' => 'resume>list({region: content.profile.region.id})',
]);

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

?>
<div class="container">
	<div class="row">

		<div class="col-sm-4 col-md-3">

			<div class="row">

				<div class="col-xs-10 col-user-pic">

					<?= Html::tag('i', null, [
						'ng-class' => "{
							'fa fa-user': content.resume.state.id == '1',
							'fa fa-user-times': content.resume.state.id == '2'
						}",
						'title' => '{{ content.resume.state.text }}'
					]); ?>

					<?= Html::tag('div', null) ?>

				</div>

				<div class="col-xs-2 col-socials">

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

				</div>

			</div>
		</div>

		<div class="col-sm-8 col-md-9">

			<?= Html::tag('h1', '{{content.profile.name}} <b>{{content.profile.family}}</b>'); ?>

			<?= Html::tag('h3', "{{content.resume.positions | tagsHelper}} в $linkResumeScope"); ?>

			<?= Html::tag('h4', "{{ content.profile.age | integerToReadable: [' год,', ' года,', ' лет,'] }} $linkProfileRegion, {{ content.profile.city.text }}"); ?>

		</div>

	</div>
</div>