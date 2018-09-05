/**
 * Pages states
 * Настройка маршрутов для старниц
 */

bolhbe
	.config(['$stateProvider', '$urlRouterProvider',
		function($stateProvider, $urlRouterProvider) {

			$urlRouterProvider
				.otherwise('/404');

			$stateProvider
				.state('page>home', {
					url: '/',
					resolve: {
						$title: ['content', '$filter',
							function(content, $filter) {

								if (content) {

									var positions,
										fullname = '';

									if (content.resume)
										positions = $filter('tagsHelper')(content.resume.positions);

									if (content.profile.name)
										fullname += content.profile.name;

									if (content.profile.family)
										fullname += ' ' + content.profile.family;

									if (positions)
										fullname = '(' + fullname + ')';

									return (positions ? positions + ' ' : '') + (fullname ? fullname : '');

								}

								return 'Вакансии в Грозном, работа в Ингушетии';

							}
						],
						content: ['$window', '$http', '$stateParams',
							function($window, $http, $stateParams) {

								return Boolean($window.localStorage.access_token) ?
									$http
										.get('user/0')
										.then(function(response) {

											if (Boolean(response.data.resume)) 			$stateParams.tpl = '/resume/view.html';
											else if (Boolean(response.data.company)) 	$stateParams.tpl = '/company/view.html';
											else 										$stateParams.tpl = '/user/view.html';

											return response.data;

										}) :
									null;

							}
						],
					},
					views: {
						'@': {
							templateUrl: function($stateParams) {
								return $stateParams.tpl || '/default/index.html';
							},
							controllerProvider: ['content',
								function(content) {
									return angular.equals(content, null) ? 'homeCtrl' : 'userViewCtrl';
								}
							],
						},
						'panel1@': {},
						'panel2@': {},
					},
					sticky: true,
				})
				.state('page>404', {
					url: '/404',
					resolve: {
						$title: function() {
							return 'Страница не найдена';
						}
					},
					views: {
						'@': {
							templateUrl: '/default/404.html',
						},
						'panel1@': {},
						'panel2@': {},
					},
					sticky: true,
				});

		}
	]);