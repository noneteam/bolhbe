bolhbe
	.controller('bodyCtrl', ['$scope', '$window', '$http', '$stickyState', '$state', '$location',
		function ($scope, $window, $http, $stickyState, $state, $location) {

			function init() {
				if ($state.current.name != 'page>home') {
					$http
						.get('user/0')
						.then(function(response) {
							$scope.user = response.data;
						}, function() {
							$state.go('page>404');
							delete $window.localStorage.access_token;
						});
				}
			};

			var ws = new ab.Session('wss://ws.bolh.be',
				function() {

					ws.subscribe('listMonitoring', function(topic, data) {

						var list = document.getElementsByClassName('list-' + data.state)[0];

						if (list) list.classList.add('blur');

						if ($state.includes(data.state + '>list')) {

							$state
								.reload()
								.then(function() {
									list.classList.remove('blur');
								});

						}

					});

				},
				function() {
					console.warn('Внимание! Соединение с веб-сокетом разорванно.');
				},
				{
					'skipSubprotocolCheck': true
				}
			);


			$scope.$watch(function() {return Boolean($window.localStorage.access_token)},
				function(now, was) {

					var login = !was && now,
						logout = was && !now;

					if (logout) delete $scope.user;
					else if (now) {
						if ($state.current.name != '') init();
						else setTimeout(init, 1000);
					}

					if (login || logout)
						$stickyState.reset('page>home');

				}
			);

			$http
				.get('location')
				.then(function(response) {
					$scope.location = response.data;
				});

			window.onpopstate = function() {

				/**
				 * Запрет возврата на предыдущую страницу через кнопку назад в браузере 
				 */

				history.pushState('', '', $location.path());

			};

			$scope.$on('pass', function(event, data, options) {

				/**
				 * Проброс и обновление данных из форм дочерних контроллеров
				 */

				$scope.$broadcast(options.target, data, options);

				if (options.update) {

					if (Boolean($scope.user[options.module])) {

						angular.forEach(data, function(value, key) {

							if (options.module) $scope.user[options.module][key] = value;
							else 				$scope.user[key] = value;

						});

					} else $scope.user[options.module] = data;

				}

				$stickyState.reset('*');

			});

		}
	])
	.controller('listCtrl', ['$scope', '$location', 'list', 'hideCities', '$title',
		function ($scope, $location, list, hideCities, $title) {


			$scope.title = angular.copy($title);

			$scope.items = list.items;
			$scope.pagination = list.pagination;
			$scope.filters = list.filters;

			$scope.showFilters = function() {

				var mobileToggler = document.getElementById('toggle-filters');

				return mobileToggler.offsetWidth == 0 && mobileToggler.offsetHeight == 0;
			};

			$scope.hideCities = function(key) {
				return key == 'city' && hideCities;
			};

			$scope.setPage = function(pageNo) {
				$scope.pagination.currentPage = pageNo;
			};

			$scope.setFilter = function(key, value) {
				$location.search(key, $location.search()[key] == null ? value : null);
			};

			$scope.pageChanged = function() {
				$location.search('page', $scope.pagination.currentPage);
			};

		}
	])
	.controller('homeCtrl', ['$scope',
		function($scope) {
		}
	]);