/**
 * Resume states
 * Настройка маршрутов для резюме
 */

bolhbe
	.config(['$stateProvider',
		function($stateProvider) {

			$stateProvider
				.state('resume>list', {
					url: '/resume?{page:int}&{region:int}&{city:int}&{scope:int}&{employment:int}&{state:int}&{sex:int}',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {

								var size = 0;

								angular.forEach($stateParams, function(value, key) {
									if (typeof value !== 'undefined' && key !== 'page') size++;
								});

								if (size === 1 && $stateParams.region === 6)
									return 'Резюме в Ингушетии';

								if (size === 1 && $stateParams.region === 95)
									return 'Резюме в Чеченской республике';

								return 'Резюме';

							}
						],
						list: ['$http', '$stateParams',
							function ($http, $stateParams) {
								return $http
									.get('resume', {params: $stateParams})
									.then(function(response) {

										if (!response.data.items.length)
											$stateParams.path = 'empty'

										return response.data;

									});
							}
						],
						hideCities: ['$stateParams',
							function ($stateParams) {
								return $stateParams.region == null;
							}
						],
					},
					views: {
						'@': {
							templateUrl: function($stateParams) {
								return '/resume/' + ($stateParams.path || 'list') + '.html';
							},
							controller: 'listCtrl'
						},
						'panel1@': {}
					},
					sticky: true
				})
				.state('resume>form', {
					url: '/resume/form',
					resolve: {
						$title: [
							function() {
								return 'Форма резюме';
							}
						],
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/scope')
									.then(function(response) {
										labels.scope = response.data.items;
									});

								$http
									.get('label/move')
									.then(function(response) {
										labels.move = response.data.items;
									});

								$http
									.get('label/trip')
									.then(function(response) {
										labels.trip = response.data.items;
									});

								$http
									.get('label/employment')
									.then(function(response) {
										labels.employment = response.data.items;
									});

								$http
									.get('label/time')
									.then(function(response) {
										labels.time = response.data.items;
									});

								return labels;

							}
						],
					},
					views: {
						'panel2@': {
							templateUrl: '/resume/form.html',
							controller: 'resumeFormCtrl',
						},
					}
				})

				.state('resume>experience>form', {
					url: '/experience/:id/form',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {
								return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' опыт работы';
							}
						],
						content: ['$http', '$stateParams',
							function($http, $stateParams) {

								return Boolean($stateParams.id) ? $http
									.get('resume/experience/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}) : {};

							}
						],
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/scope')
									.then(function(response) {
										labels.scope = response.data.items;
									})

								return labels;
							}
						]
					},
					views: {
						'panel1@': {
							templateUrl: '/resume/form-experience.html',
							controller: 'resumeModuleFormCtrl',
						},
					},
				})
				.state('resume>university>form', {
					url: '/university/:id/form',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {
								return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' образование';
							}
						],
						content: ['$http', '$stateParams',
							function($http, $stateParams) {

								return Boolean($stateParams.id) ? $http
									.get('resume/university/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}) : {};

							}
						],
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/level?type=2')
									.then(function(response) {
										labels.level = response.data.items;
									});

								$http
									.get('label/diploma')
									.then(function(response) {
										labels.diploma = response.data.items;
									});

								return labels;
							}
						],
					},
					views: {
						'panel1@': {
							templateUrl: '/resume/form-university.html',
							controller: 'resumeModuleFormCtrl',
						},
					},
				})
				.state('resume>language>form', {
					url: '/language/:id/form',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {
								return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' владение языком';
							}
						],
						content: ['$http', '$stateParams',
							function($http, $stateParams) {

								return Boolean($stateParams.id) ? $http
									.get('resume/language/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}) : {};

							}
						],
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/language')
									.then(function(response) {
										labels.language = response.data.items;
									});

								$http
									.get('label/level?type=1')
									.then(function(response) {
										labels.level = response.data.items;
									});


								return labels;
							}
						],
					},
					views: {
						'panel1@': {
							templateUrl: '/resume/form-language.html',
							controller: 'resumeModuleFormCtrl',
						},
					},
				})
				.state('resume>course>form', {
					url: '/course/:id/form',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {
								return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' дополнительный курс';
							}
						],
						content: ['$http', '$stateParams',
							function($http, $stateParams) {

								return Boolean($stateParams.id) ? $http
									.get('resume/course/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}) : {};

							}
						],
						labels: ['$http',
							function($http) {

								var labels = {};

								$http
									.get('label/certificate')
									.then(function(resolve) {
										labels.certificate = resolve.data.items;
									});

								return labels;
							}
						],
					},
					views: {
						'panel1@': {
							templateUrl: '/resume/form-course.html',
							controller: 'resumeModuleFormCtrl',
						},
					},
				})
				.state('resume>test>form', {
					url: '/test/:id/form',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {
								return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' пройденные тесты';
							}
						],
						content: ['$http', '$stateParams',
							function($http, $stateParams) {

								return Boolean($stateParams.id) ? $http
									.get('resume/test/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}) : {};

							}
						],
						labels: function() {}
					},
					views: {
						'panel1@': {
							templateUrl: '/resume/form-test.html',
							controller: 'resumeModuleFormCtrl',
						},
					},
				});

		}
	]);