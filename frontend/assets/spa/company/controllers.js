bolhbe
	.controller('companyFormCtrl', ['$scope', 'labels', '$http',
		function ($scope, labels, $http) {

			$scope.options = {
				labels: labels,
				default: {
					scope: {
						id: 1
					}
				},
			};

			$scope.model = angular.copy($scope.user.company || $scope.options.default);

			$scope.options.request = {
				method: $scope.model.id ? 'PUT' : 'POST',
			};

			angular.forEach(['count', 'vacancy'],
				function(model) {
					delete $scope.model[model];
				}
			);

			$scope.submitFn = function() {

				$http({
					url: 'company',
					method: $scope.options.request.method,
					data: $scope.model,
				}).then(function(response) {

					$scope.$emit('pass', response.data, {
						update: true,
						module: 'company',
						target: 'fillContent',
					});

					$('mmenu-sidebar').data('mmenu').close();

				});

			};

		}
	]);