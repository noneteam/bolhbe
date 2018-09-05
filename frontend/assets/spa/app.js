var bolhbe = angular.module('bolhbe', [
	'ui.router',
	'ui.router.title',
	'ct.ui.router.extras',
	'ngSanitize',
	'textAngular',
	'ui.mask',
	'oi.select',
	'ui.bootstrap',
]);

bolhbe
	.config(['$locationProvider', '$httpProvider', '$qProvider', '$provide',
		function($locationProvider, $httpProvider, $qProvider, $provide) {

			$locationProvider
				.html5Mode({
					enabled: true,
					requireBase: false
				});

			$httpProvider
				.interceptors
				.push('apiInterceptor');

			$qProvider
				.errorOnUnhandledRejections(false);

			$provide
				.decorator('taOptions', ['taRegisterTool', '$delegate',
					function(taRegisterTool, $delegate) {

						$delegate.toolbar = [
							['html', 'insertLink', 'bold', 'italics', 'underline', 'strikeThrough', 'ul', 'ol', 'quote'],
						];

						return $delegate;
					}
				]);

		}
	])
	.run(['$rootScope', '$state', '$previousState',
		function($rootScope, $state, $previousState) {

			$rootScope.$on('$stateChangeStart',
				function(event, toState, toParams, fromState, fromParams) {

					if (toState.views && !Boolean(toState.views['@'])) {

						if (fromState.views && Boolean(fromState.views['@']))
							$previousState.memo('mm');

						if (!fromState.name) {

							var goState = toState.parent || 'page>home';

							if (toState.name == 'vacancy>form')
								goState = 'vacancy>list';

							event.preventDefault();

							$state
								.go(goState, toParams, {location: false})
								.then(function() {
									$state.go(toState, toParams);
								});

						}

					}

				}
			);

			$rootScope.$on('$stateChangeSuccess',
				function(event, toState, toParams, fromState, fromParams) {

					delete $rootScope.$active;

					if (toState.name.indexOf('vacancy') !== -1)
						$rootScope.$active = 'vacancy';
					else if (toState.name.indexOf('resume') !== -1)
						$rootScope.$active = 'resume';
					else if (toState.name.indexOf('company') !== -1)
						$rootScope.$active = 'company';
					else if (toState.name.indexOf('signup') !== -1)
						$rootScope.$active = 'signup';
					else if (toState.name.indexOf('user') !== -1 && toState.name != 'user>view')
						$rootScope.$active = 'user';

				}
			);

		}
	])
	.factory('apiInterceptor', ['$q', '$window', '$injector', '$timeout', '$rootScope',
		function($q, $window, $injector, $timeout, $rootScope) {
			return {

				request: function(config) {

					// Исключение конфигурации для запросов про шаблоны
					if(config.url.indexOf('.html') !== -1)
						return config;

					// Подкрепление запроса токеном для авторизации
					if ($window.localStorage.access_token)
						config.headers.authorization = 'Bearer ' + $window.localStorage.access_token;

					// Подкрепление запроса токеном для восстановления пароля
					if ($window.sessionStorage.reset_token)
						config.headers.Token = $window.sessionStorage.reset_token;

					// Переключение стандартной модели для запросов из контроллеров
					if (Boolean(config.setModel))
						config.headers['Set-Model'] = config.setModel;

					// Разрешаю отправлять модель в запросе удаления
					config.headers['Content-Type'] = 'application/json';

					// Предотвращение кэширования запросов браузером
					config.headers['Cache-Control'] = 'no-cache';

					// Настройка перенаправления запросов на API-интерфейс
					config.url = 'https://api.bolh.be/' + config.url;

					delete config.setModel;

					return config;

				},

				responseError: function(rejection) {

					// Редирект для неавторизованнх на форму входа
					if (rejection.status === 401)
						$injector.get('$state').go('login');

					/**
					 * Пересылка ответа про не валидные данные в директиву 'fieldResponse',
					 * disableErrors берется из директивы 'oiSelect'
					 */
					if (rejection.status === 422 && !rejection.config.disableErrors)
						$rootScope.$broadcast('fillErrors', rejection.data);

					return $q.reject(rejection);

				}

			};
		}
	])
	.service('content',
		function() {

			/**
			 * Псевдо-сервис переопределяемый в состояниях,
			 * необходим для заглушки
			 */

		}
	)
	.constant('months', [
		'янв.',
		'февр.',
		'мар.',
		'апр.',
		'мая',
		'июня',
		'июля',
		'авг.',
		'сент.',
		'окт.',
		'нояб.',
		'дек.'
	]);