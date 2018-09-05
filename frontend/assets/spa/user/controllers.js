bolhbe
	.controller('loginCtrl', ['$scope', '$http', '$window', '$interval',
		function($scope, $http, $window, $interval) {

			/**
			 * Контроллер авторизации пользователя
			 */

			$scope.submitFn = function() {

				/**
				 * Отправка формы авторизации
				 */

				$http
					.post('user/gate', $scope.model)
					.then(function(response) {

						$window.localStorage.access_token = response.data;
						$('mmenu-sidebar').data('mmenu').close();

					});

			};

			$scope.submitFb = function() {

				/**
				 * Авторизация|Регистрация по профилю в фейсбуке
				 */

				window.open('https://api.bolh.be/user/auth?authclient=facebook', '', 'width=860,height=480');

				var checkToken = $interval(function() {
					if ($window.localStorage.access_token) {

						$('mmenu-sidebar').data('mmenu').close();
						$interval.cancel(checkToken);

					}
				}, 1000);

			};

		}
	])
	.controller('passwordCtrl', ['$scope', '$http', '$window', '$state',
		function($scope, $http, $window, $state) {

			/**
			 * Контроллер изменения|восстановления пароля
			 */

			$scope.requestFn = function() {

				/**
				 * Запрос токенда для семены пароля (Шаг 1)
				 */

				$http
					.post('user/password', $scope.model)
					.then(function(response) {

						$window.sessionStorage.reset_token = response.data;
						$state.go('user>login>reset');

					});
			};

			$scope.resetFn = function() {

				/**
				 * Семена пароля с использованием токена (Шаг 2)
				 */

				$http
					.patch('user/password', $scope.model)
					.then(function(response) {

						delete $window.sessionStorage.reset_token;
						$window.localStorage.access_token = response.data;
						$('mmenu-sidebar').data('mmenu').close(); 

					});
			};

			$scope.submitFn = function() {

				/**
				 * Смена пароля авторизованным пользователем
				 */

				$http
					.put('user/password', $scope.model)
					.then(function(response) {

						$('mmenu-sidebar').data('mmenu').close();

					});
			};

		}
	])
	.controller('signupCtrl', ['$scope', '$http', '$window', '$state',
		function($scope, $http, $window, $state) {

			/**
			 * Контроллер регистрации пользователя обслуживает 2 состояния (user>signup, user>signup>fast)
			 */

			$scope.submitFn = function(setModel) {

				/**
				 * Отправка формы регистрации
				 * @var setModel переключает модель в конфигураторе закпроса
				 */

				$http
					.post('user', $scope.model, {setModel: setModel})
					.then(function(response) {

						$window.localStorage.access_token = response.data;

						if (Boolean(setModel)) {
							$scope.$watch('user', function(now) {
								if (Boolean(now)) $state.go('user>form');
							});
						} else $('mmenu-sidebar').data('mmenu').close();

					});
			};

		}
	])
	.controller('menuCtrl', ['$scope', '$previousState', '$state', '$window', '$http', '$interval',
		function($scope, $previousState, $state, $window, $http, $interval) {

			/**
			 * Контроллер панели управления|навигации пользователя
			 */

			$scope.options = {
				phone: {
					connect: !Boolean($scope.user.phone),
				},
				facebook: {
					show: $scope.user.roles.indexOf('facebookUser') === -1 && !Boolean($scope.user.profile.facebookcom) && Boolean($scope.user.phone),
				},
				resume: {
					label: ($scope.user.roles.indexOf('worker') !== -1 ? 'Изменить' : 'Добавить') + ' резюме',
					disabled: $scope.user.roles.indexOf('user') === -1,
				},
				company: {
					label: ($scope.user.roles.indexOf('employer') !== -1 ? 'Изменить' : 'Добавить') + ' компанию',
					disabled: $scope.user.roles.indexOf('user') === -1,
				}
			};

			$scope.goVacancy = function() {

				/**
				 * Анимированный переход в список вакансий пользователя из боковой панели
				 */

				$state
					.go('vacancy>list', {user: 1})
					.then(function() {

						$previousState.forget('mm');
						$('mmenu-sidebar').data('mmenu').close();

					});

			};

			$scope.connectFb = function() {

				/**
				 * 
				 */

				window.open('https://api.bolh.be/user/auth?authclient=facebook&connect=true', '', 'width=860,height=480');

				var checkToken = $interval(function() {

					if ($window.localStorage.facebook) {

						$interval.cancel(checkToken);

						$http({
							method: 'PUT',
							url: 'user',
							data: {facebook_hash: $window.localStorage.facebook},
							setModel: 'FacebookConnect'
						}).then(function () {

							delete $window.localStorage.facebook;
							$('mmenu-sidebar').data('mmenu').close();

						});

					};

				}, 1000);

			};

			$scope.logout = function() {

				/**
				 * Выход с сайта
				 */

				delete $window.localStorage.access_token;
				$('mmenu-sidebar').data('mmenu').close();

			};
		}
	])
	.controller('userViewCtrl', ['$scope', 'content', '$state', '$filter', 'months', '$rootScope',
		function ($scope, content, $state, $filter, months, $rootScope) {

			$scope.content = content;

			if ($state.current.name == 'page>home')
				$scope.$parent.user = content;
			else if (Boolean($scope.content.resume))
				$rootScope.$active = 'resume';
			else if (Boolean($scope.content.company))
				$rootScope.$active = 'company';

			$scope.orderByDate = function(item) {

				/**
				 * Сортировка для опыта работы в резюме
				 */

				var result = new Date();

				if (item.dismissed) {
					var data = item.dismissed.split(' ');
					result = new Date(data[1], months.indexOf(data[0]));
				}

				return -result;
			};

			$scope.$on('fillContent', function(event, data, options) {

				if ($scope.user.id !== content.id)
					return;

				if ($scope.content[options.module]) {

					angular.forEach(data, function(value, key) {

						if (options.module) $scope.content[options.module][key] = value;
						else 				$scope.content[key] = value;

					});

				} else $scope.content[options.module] = data;

			});

			$scope.$on('fillModule', function(event, data, options) {

				if ($scope.user.id !== content.id)
					return;

				data.hired = data.hired ? $filter('date')(new Date(data.hired), 'MMM yyyy') : null;
				data.dismissed = data.dismissed ? $filter('date')(new Date(data.dismissed), 'MMM yyyy') : null;

				if (options.method === 'POST') 					$scope.content.resume[options.module].push(data);
				else {

					angular.forEach($scope.content.resume[options.module], function(value, key) {
						if (value.id === data.id) {

							if (options.method === 'DELETE') 	$scope.content.resume[options.module].splice(key, 1);
							else 								$scope.content.resume[options.module][key] = data;

						}
					});

				}
			});

		}
	])
	.controller('userFormCtrl', ['$scope', 'labels', '$http', '$filter', '$window',
		function($scope, labels, $http, $filter, $window) {

			/**
			 * Контроллер обработки форм трех состояний (user>form, user>phone>update, user>phone>connect)
			 */

			$scope.model = angular.copy($scope.user.profile);

			$scope.model.region = $scope.model.region || $scope.location.region;
			$scope.model.city = $scope.model.city || $scope.location.city

			$scope.options = {
				labels: labels,
				date: {
					showWeeks: false,
					maxDate: new Date(),
					datepickerMode: 'year'
				},
				stamp: {
					birthday: new Date($scope.model.birthday)
				},
				request: {
					method: 'PUT',
					setModel: false
				}
			};

			$scope.submitFn = function() {

				/**
				 * Отправка формы изменения профиля работа с телефоном
				 */

				$scope.model.birthday = $filter('date')($scope.options.stamp.birthday, 'yyyy-MM-dd');

				$http({
					method: $scope.options.request.method,
					url: 'user',
					data: $scope.model,
					setModel: $scope.options.request.setModel
				}).then(function(response) {

					if ($scope.user.roles.indexOf('user') === -1 && Boolean($scope.user.phone))
						$scope.user.roles.push('user');

					if ($scope.options.request.method === 'DELETE')
						delete $window.localStorage.access_token;

					$scope.$emit('pass', response.data, {
						update: true,
						module: !$scope.options.request.setModel ? 'profile' : false,
						target: 'fillContent'
					});

					$('mmenu-sidebar').data('mmenu').close();

				});
			};

			$scope.phone = {
				availabilityFn: function(id) {

					$scope.options.request.setModel = 'PhoneAvailabilitySet';

					$scope.model.show_phone = {
						id: id
					};

				},
				submitFn: function(setModel) {

					$scope.options.request.setModel = setModel;

					$scope.submitFn();

				}
			};

		}
	]);