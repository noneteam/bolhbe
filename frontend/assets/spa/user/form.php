<?php
/**
 * Форма редактирвания профиля
 */
use yii\helpers\Html;

$iconSave = Html::tag('i', null, [
	'class' => 'fa fa-floppy-o'
]);

$submitButton = Html::button("$iconSave " . Html::tag('span', 'Сохранить', ['class' => 'hidden-xs']), [
	'type' => 'submit',
	'class' => 'btn btn-success btn-lg pull-right',
]);

$iconDelete = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-trash'
]);

$deleteButton = Html::button($iconDelete, [
	'type' => 'submit',
	'class' => 'btn btn-danger btn-lg pull-right btn-delete',
]);

$calendarIcon = Html::tag('i', null, [
	'class' => 'glyphicon glyphicon-calendar'
]);

$userPlusIcon = Html::tag('i', null, [
	'class' => 'fa fa-user-plus'
]);

$usersIcon = Html::tag('i', null, [
	'class' => 'fa fa-users'
]);

$globeIcon = Html::tag('i', null, [
	'class' => 'fa fa-globe'
]);

$setAvailabilityPhone = Html::button($userPlusIcon, [
	'type' => 'submit',
	'class' => 'btn',
	'title' => 'Мне и пригласившим',
	'ng-click' => 'phone.availabilityFn(1)',
	'ng-disabled' => 'user.show_phone.id == 1',
]). Html::button($usersIcon, [
	'type' => 'submit',
	'class' => 'btn',
	'title' => 'Всем зарегистрированным',
	'ng-click' => 'phone.availabilityFn(2)',
	'ng-disabled' => 'user.show_phone.id == 2',
]). Html::button($globeIcon, [
	'type' => 'submit',
	'class' => 'btn',
	'title' => 'Всем пользователям',
	'ng-click' => 'phone.availabilityFn(3)',
	'ng-disabled' => 'user.show_phone.id == 3',
]);

$setAvailabilityPhoneWrapper = Html::tag('div', $setAvailabilityPhone, [
	'class' => 'input-group show-phone-wrapper',
]);

?>

<?= Html::tag('h2', '{{$title}}', ['class' => 'sidebar-title go-blur']) ?>

<form ng-submit="submitFn()" mmenu-auto='{"panel": "panel3"}'>

	<div class="go-blur">

		<div class="row">

			<div class="form-group form-group-response col-sm-6">

				<?= Html::tag('label', 'Имя', ['class' => 'control-label', 'for' => 'profile-form-name']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'profile-form-name',
					'class' => 'form-control',
					'ng-model' => 'model.name',
					'mmenu-focus' => true,
				]); ?>

			</div>

			<div class="form-group form-group-response col-sm-6">

				<?= Html::tag('label', 'Фамилия', ['class' => 'control-label', 'for' => 'profile-form-family']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'profile-form-family',
					'class' => 'form-control',
					'ng-model' => 'model.family',
				]) ?>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'День рождения', ['class' => 'control-label', 'for' => 'profile-form-birthday']); ?>

				<div class="input-group">
					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-birthday',
						'class' => 'form-control',
						'uib-datepicker-popup' => 'dd MMM yyyy',
						'ng-model' => 'options.stamp.birthday',
						'ng-readonly' => 'true',
						'is-open' => 'isOpenCalendar',
						'datepicker-options' => 'options.date',
						'show-button-bar' => 'false',
					]); ?>
					<?= Html::tag('span', $calendarIcon, [
						'class' => 'input-group-addon',
						'ng-click' => 'isOpenCalendar = true',
					]); ?>
				</div>

			</div>

			<div class="form-group field-response col-sm-6">

				<?= Html::tag('label', 'Пол', ['class' => 'control-label', 'for' => 'profile-form-sex']); ?>

				<?= Html::dropDownList('profile-form-sex', '', [], [
					'id' => 'profile-form-sex',
					'class' => 'form-control',
					'ng-model' => 'model.sex',
					'ng-options' => 'label as label.text for label in options.labels.sex track by label.id',
				]); ?>

			</div>

		</div>

		<?= Html::tag('div', 'Местонахождение', [
			'role' => 'button',
			'data-toggle' => 'collapse',
			'href' => '#location',
		]); ?>

		<div class="collapse" id="location" ng-class="{'in': !model.region || !model.city}">

			<div class="form-group field-response">

				<?= Html::tag('label', 'Регион', ['class' => 'control-label']); ?>

				<?= Html::tag('oi-select', null, [
					'oi-options' => 'item.text for item in tags.load("location/region", $query)',
					'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("location", "region", $query)\',}',
					'ng-model' => 'model.region',
				]); ?>

			</div>

			<div class="form-group field-response">

				<?= Html::tag('label', 'Город', ['class' => 'control-label']); ?>

				<?= Html::tag('oi-select', null, [
					'oi-options' => 'item.text for item in tags.load("location/city", $query)',
					'oi-select-options' => '{newItem: true, newItemFn: \'tags.add("location", "city", $query)\',}',
					'ng-model' => 'model.city',
				]); ?>

			</div>

		</div>

		<?= Html::tag('div', 'Я в соцсети', [
			'role' => 'button',
			'data-toggle' => 'collapse',
			'href' => '#social',
			'aria-expanded' => 'false',
		]); ?>

		<div class="collapse" id="social">

			<div class="form-group field-response">

				<?= Html::tag('label', 'Email', ['class' => 'control-label', 'for' => 'profile-form-email']); ?>

				<?= Html::tag('input', null, [
					'type' => 'text',
					'id' => 'profile-form-email',
					'class' => 'form-control',
					'ng-model' => 'model.email',
				]); ?>

			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','https://www.facebook.com/', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-facebookcom'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-facebookcom',
						'class' => 'form-control',
						'ng-model' => 'model.facebookcom',
						'ng-disabled' => 'user.facebook_connected'
					]); ?>

				</div>
			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','https://youtube.com/user/', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-youtubecom'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-youtubecom',
						'class' => 'form-control',
						'ng-model' => 'model.youtubecom',
					]); ?>

				</div>
			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','twitter@', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-twittercom'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-twittercom',
						'class' => 'form-control',
						'ng-model' => 'model.twittercom',
					]); ?>

				</div>
			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','https://vk.com/', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-vkcom'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-vkcom',
						'class' => 'form-control',
						'ng-model' => 'model.vkcom',
					]); ?>

				</div>
			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','http://ok.ru/', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-okru'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-okru',
						'class' => 'form-control',
						'ng-model' => 'model.okru',
					]); ?>

				</div>
			</div>

			<div class="form-group field-response">
				<div class="input-group">

					<?= Html::tag('label','Skype live:', [
						'class' => 'input-group-addon',
						'for' => 'profile-form-skype'
					]); ?>

					<?= Html::tag('input', null, [
						'type' => 'text',
						'id' => 'profile-form-skype',
						'class' => 'form-control',
						'ng-model' => 'model.skype',
					]); ?>

				</div>
			</div>

		</div>

		<?= Html::tag('div', $submitButton . $deleteButton . $setAvailabilityPhoneWrapper, [
			'class' => 'submit-panel',
		]); ?>

	</div>

	<?= $this->render('../default/_protect') ?>

</form>