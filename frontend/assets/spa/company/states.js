/**
 * Company states
 * Настройка маршрутов для компаний
 */

bolhbe
	.config(['$stateProvider',
		function($stateProvider) {

			$stateProvider
				.state('company>list', {
					url: '/company?{page:int}&{region:int}&{city:int}&{scope:int}',
					resolve: {
						$title: function() {
							return 'Компании';
						},
						list: ['$http', '$stateParams',
							function ($http, $stateParams) {
								return $http
									.get('company', {params: $stateParams})
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
								return '/company/' + ($stateParams.path || 'list') + '.html';
							},
							controller: 'listCtrl'
						},
						'panel1@': {}
					},
					sticky: true
				})
				.state('company>form', {
					url: '/company/form',
					resolve: {
						$title: [
							function() {
								return 'Форма компании';
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

								return labels;

							}
						],
					},
					views: {
						'panel2@': {
							templateUrl: '/company/form.html',
							controller: 'companyFormCtrl',
						}
					}
				});

		}
	]);