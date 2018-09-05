bolhbe
	.controller('resumeFormCtrl', ['$scope', 'labels', '$filter', '$http',
		function ($scope, labels, $filter, $http) {

			$scope.options = {
				labels: labels,
				default: {
					scope: {
						id: 1,
					},
					move: {
						id: 1,
					},
					trip: {
						id: 1,
					},
					time: {
						id: 1,
					},
					employment: {
						id: 1,
					},
				},
			};

			$scope.model = angular.copy($scope.user.resume || $scope.options.default);

			angular.forEach(['count', 'course', 'experience', 'language', 'test', 'university'],
				function(model) {
					delete $scope.model[model];
				}
			);

			$scope.options.stamp = {
				positions: $filter('tagsHelper')($scope.model.positions, {form: true}),
			};

			$scope.options.request = {
				method: $scope.model.id ? 'PUT' : 'POST',
				setModel: null
			};

			$scope.submitFn = function() {

				$scope.model.positions = $scope.options.stamp.positions;

				$http({
					url: 'resume',
					method: $scope.options.request.method,
					data: $scope.model,
					setModel: $scope.options.request.setModel
				}).then(function(response) {


					$scope.$emit('pass', response.data, {
						update: true,
						module: 'resume',
						target: 'fillContent',
					});

					$('mmenu-sidebar').data('mmenu').close();

				});

			};

			$scope.state = {
				set: function(id) {

					$scope.options.request.setModel = 'ResumeState';

					$scope.model.state = {
						id: id
					};

					$scope.submitFn();

				},
			};

		}
	])
	.controller('resumeModuleFormCtrl', ['$scope', 'content', 'labels', '$filter', '$http', 'months',
		function ($scope, content, labels, $filter, $http, months) {

			$scope.options = {
				labels: labels,
				default: {
					scope: {
						id: 1,
					},
					diploma: {
						id: 1,
					},
					language: {
						id: 1,
					},
					certificate: {
						id: 1,
					},
					level: {
						id: 1
					},
				},
				date: {
					showWeeks: false,
					maxDate: new Date(),
					minMode: 'month',
				},
			};

			$scope.model = angular.equals(content, {}) ? $scope.options.default : content;

			$scope.options.request = {
				method: $scope.model.id ? 'PUT' : 'POST',
			};

			$scope.submitFn = function(module) {

				$http({
					url: 'resume/' + module + ($scope.model.id ? '/' + $scope.model.id : ''),
					method: $scope.options.request.method,
					data: $scope.model,
				}).then(function(response) {

					$scope.$emit('pass', response.data.id ? response.data : {id: $scope.model.id}, {
						target: 'fillModule',
						method: $scope.options.request.method,
						module: module,
					});

					$('mmenu-sidebar').data('mmenu').close();

				});

			};

			$scope.experience = {
				initFn: function() {

					var hired = $scope.model.hired ? $scope.model.hired.split(' ') : false;
					var dismissed = $scope.model.dismissed ? $scope.model.dismissed.split(' ') : false;

					$scope.options.stamp = {
						hired: hired ? new Date(hired[1], months.indexOf(hired[0])) : null,
						dismissed: dismissed ? new Date(dismissed[1], months.indexOf(dismissed[0])) : null
					};

				},
				submitFn: function() {

					$scope.model.hired = $filter('date')($scope.options.stamp.hired, 'yyyy-MM');

					$scope.model.dismissed = $filter('date')($scope.options.stamp.dismissed, 'yyyy-MM');

					$scope.submitFn('experience');

				}

			};

		}
	]);