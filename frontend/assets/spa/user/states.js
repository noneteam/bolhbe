/**
 * Настройка маршрутов для пользователей
 */

bolhbe
	.config(['$stateProvider',
		function($stateProvider) {

			$stateProvider
				.state('user>menu', {
					url: '/user/menu',
					resolve: {
						$title: function() {
							return 'Меню';
						}
					},
					views: {
						'panel1@': {
							templateUrl: '/user/menu.html',
							controller: 'menuCtrl',
						},
					},
					sticky: true,
				})
				.state('user>view', {
					url: '/user/{id:int}',
					resolve: {
						$title: ['content', '$filter',
							function(content, $filter) {

								var title,
									fullname;

								if (content.resume) 		title = $filter('tagsHelper')(content.resume.positions);
								else if (content.company) 	title = content.company.title.text;

								if (content.profile.name)
									fullname = content.profile.name;

								if (content.profile.family)
									fullname += ' ' + content.profile.family;

								if (title)
									fullname = '(' + fullname + ')';

								return (title ? title + ' ' : '') + (fullname ? fullname : '');

							}
						],
						content: ['$http', '$stateParams', '$state',
							function($http, $stateParams, $state) {

								return $http
									.get('user/' + $stateParams.id)
									.then(function(response) {

										if (Boolean(response.data.resume)) 			$stateParams.tpl = '/resume/view.html';
										else if (Boolean(response.data.company)) 	$stateParams.tpl = '/company/view.html';
										else 										$stateParams.tpl = '/user/view.html';

										return response.data;

									}, function(error) {

										if (error.status === 404)
											$state.go('page>404');

									});

							}
						]
					},
					views: {
						'@': {
							templateUrl: function($stateParams) {
								return $stateParams.tpl;
							},
							controller: 'userViewCtrl',
						},
						'panel1@': {},
					},
					sticky: true,
				})
				.state('user>login', {
					url: '/login',
					resolve: {
						$title: function() {
							return 'Войти на сайт';
						}
					},
					views: {
						'panel1@': {
							templateUrl: '/user/form-login.html',
							controller: 'loginCtrl',
						},
					},
					sticky: true,
				})
				.state('user>login>request', {
					url: '/login/request',
					resolve: {
						$title: function() {
							return 'Восстановить пароль';
						}
					},
					views: {
						'panel2@': {
							templateUrl: '/user/form-login-request.html',
							controller: 'passwordCtrl'
						}
					},
					sticky: true,
				})
				.state('user>login>reset', {
					url: '/login/reset',
					resolve: {
						$title: function() {
							return 'Изменить пароль';
						}
					},
					views: {
						'panel3@': {
							templateUrl: '/user/form-login-reset.html',
							controller: 'passwordCtrl'
						}
					},
				})

				.state('user>form', {
					url: '/user/form',
					resolve: {
						$title: function() {
							return 'Редактировать профиль';
						},
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/sex')
									.then(function(response) {
										labels.sex = response.data.items;
									});

								return labels;

							}
						],
					},
					views: {
						'panel3@': {
							templateUrl: '/user/form.html',
							controller: 'userFormCtrl',
						},
					},
				})
				.state('user>signup', {
					url: '/signup',
					resolve: {
						$title: function() {
							return 'Регистрация на сайте';
						}
					},
					views: {
						'panel2@': {
							templateUrl: '/user/form-signup.html',
							controller: 'signupCtrl',
						},
					},
				})
				.state('user>signup>fast', {
					url: '/go',
					resolve: {
						$title: function() {
							return 'Быстрая регистрация';
						}
					},
					views: {
						'panel2@': {
							templateUrl: '/user/form-signup-fast.html',
							controller: 'signupCtrl',
						},
					},
				})
				.state('user>password>form', {
					url: '/user/password',
					resolve: {
						$title: function() {
							return 'Изменить пароль';
						}
					},
					views: {
						'panel2@': {
							templateUrl: '/user/form-password.html',
							controller: 'passwordCtrl'
						}
					},
				})
				.state('user>phone>form', {
					url: '/user/phone',
					resolve: {
						$title: function() {
							return 'Форма телефона';
						},
						labels: function() {}
					},
					views: {
						'panel2@': {
							templateUrl: '/user/form-phone.html',
							controller: 'userFormCtrl'
						}
					},
				});

		}
	]);