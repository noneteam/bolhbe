bolhbe
	.controller('vacancyViewCtrl', ['$scope', 'content',
		function ($scope, content) {

			$scope.content = content;

			$scope.$on('fillContent', function(event, data) {

				/**
				 * Наполнение контентом из ответа отправленной формы в vacancyFormCtrl,
				 * притекает чере bodyCtrl
				 */

				angular.forEach(data, function(value, key) {
					$scope.content[key] = value;
				});

			});

		}
	])
	.controller('vacancyFormCtrl', ['$scope', 'labels', 'content', '$http', '$state', '$previousState', '$stickyState',
		function ($scope, labels, content, $http, $state, $previousState, $stickyState) {

			$scope.options = {
				labels: labels,
				default: {
					scope: {
						id: 1,
					},
					employment: {
						id: 1,
					},
					experience: {
						id: 1,
					},
					company_place: {
						id: 1,
						text: 'Нет названия',
					},
					content: "<p>Опишите вакансию коротко, в двух словах.</p><p><strong>Требования:</strong></p><ul><li></li></ul><p><strong>Условия:</strong></p><ul><li></li></ul><p><strong>Обязанности:</strong></p><ul><li></li></ul>",
					region: $scope.location.region || ($scope.user ? $scope.user.profile.region : null),
					city: $scope.location.city || ($scope.user ? $scope.user.profile.city : null),
				},
			};

			$scope.model = angular.equals(content, {}) ?
				$scope.options.default :
				angular.copy(content);

			$scope.options.request = {
				method: $scope.model.id ? 'PUT' : 'POST',
				setModel: null
			};

			$scope.submitFn = function() {

				$http({
					url: 'vacancy' + ($scope.model.id ? '/' + $scope.model.id : ''),
					method: $scope.options.request.method,
					data: $scope.model,
					setModel: $scope.options.request.setModel
				}).then(function(response) {

					if ($scope.options.request.method === 'PUT')
						$scope.$emit('pass', response.data, {target: 'fillContent'});
					else {

						$previousState.forget('mm');
						$stickyState.reset('vacancy>list');
						$state.go('vacancy>list');

					}

					$('mmenu-sidebar').data('mmenu').close();

				});

			};

		}
	])