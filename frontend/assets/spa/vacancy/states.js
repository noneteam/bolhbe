/**
 * Vacancy states
 * Настройка маршрутов для вакансий
 */

bolhbe
	.config(['$stateProvider',
		function($stateProvider) {

			var resolve = {
				$title: ['$stateParams',
					function($stateParams) {
						return (Boolean($stateParams.id) ? 'Изменить' : 'Добавить') + ' вакансию';
					}
				],
				labels: ['$http',
					function ($http) {

						var labels = {};

						$http
							.get('label/scope')
							.then(function(response) {
								labels.scope = response.data.items;
							});

						$http
							.get('label/employment')
							.then(function(response) {
								labels.employment = response.data.items;
							});

						$http
							.get('label/experience')
							.then(function(response) {
								labels.experience = response.data.items;
							});

						return labels;

					}],
			},
			views = {
				'panel2@': {
					templateUrl: '/vacancy/form.html',
					controller: 'vacancyFormCtrl',
				}
			};

			$stateProvider
				.state('vacancy>list', {
					url: '/vacancy?{user:int}&{page:int}&{region:int}&{city:int}&{scope:int}&{experience:int}&{employment:int}',
					resolve: {
						$title: ['$stateParams',
							function($stateParams) {

								var size = 0;

								angular.forEach($stateParams, function(value, key) {
									if (typeof value !== 'undefined' && key !== 'page') size++;
								});

								if (size === 1 && $stateParams.region === 6)
									return 'Вакансии в Ингушетии';

								if (size === 1 && $stateParams.region === 95)
									return 'Вакансии в Чеченской республике';

								return 'Вакансии';
							}
						],
						list: ['$http', '$stateParams',
							function ($http, $stateParams) {
								return $http
									.get('vacancy', {params: $stateParams})
									.then(function(response) {

										if (!response.data.items.length)
											$stateParams.path = 'empty';

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
								return '/vacancy/' + ($stateParams.path || 'list') + '.html';
							},
							controller: 'listCtrl'
						},
						'panel1@': {},
					},
					sticky: true
				})
				.state('vacancy>view', {
					url: '/vacancy/{id:int}',
					resolve: {
						$title: ['content',
							function(content) {
								return content.position.text;
							}
						],
						content: ['$http', '$stateParams', '$state',
							function ($http, $stateParams, $state) {
								return $http
									.get('vacancy/' + $stateParams.id)
									.then(function(response) {
										return response.data;
									}, function(error) {

										if (error.status === 404)
											$state.go('page>404');

										$stateParams.path = 'expired';

										return JSON.parse(error.data.message);

									});
							}
						]
					},
					views: {
						'@': {
							templateUrl: function($stateParams) {
								return '/vacancy/'+ ($stateParams.path || 'view') +'.html';
							},
							controller: 'vacancyViewCtrl',
						},
						'panel1@': {}
					},
					sticky: true
				})
				.state('vacancy>form', {
					url: '/vacancy/form',
					resolve: resolve,
					views: views
				})
				.state('vacancy>view>form', {
					url: '/form',
					parent: 'vacancy>view',
					resolve: resolve,
					views: views
				})
			}
	]);