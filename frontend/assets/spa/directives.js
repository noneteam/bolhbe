bolhbe
	.directive('brandNavigation', function() {
		return {

			restrict: 'C',

			link: function(scope, nav, attrs) {

				var className = 'brand-navigation-grey';

				scope.$watch(function() {return document.getElementsByTagName('header')[0];}, function(value) {

					if (value) {
						nav.addClass(className);

						window.onscroll = function() {

							var scrolled = window.pageYOffset || document.documentElement.scrollTop,
								headerPassed = value.clientHeight - scrolled <= 0;

							if (headerPassed) 	nav.removeClass(className);
							else 				nav.addClass(className);
						}
					} else 						nav.removeClass(className);

				});

			},

		};
	})
	.directive('mmenuSidebar', ['$previousState',
		function($previousState) {
			return {

				restrict: 'E',

				template: 	'<div id="panel1">'+
								'<div ui-view="panel1"></div>'+
							'</div>'+
							'<div id="panel2">'+
								'<div ui-view="panel2"></div>'+
							'</div>'+
							'<div id="panel3">'+
								'<div ui-view="panel3"></div>'+
							'</div>',

				link: function(scope, element, attrs) {

					$(element)
						.mmenu({
							offCanvas: {
								position: 'right'
							},
							extensions: [
								'effect-menu-slide'
							],
						})
						.data('mmenu')
						.bind('closed', function() {
							$previousState.go('mm'/*, {notify: false}*/);
						});

					$(element)
						.find('.mm-navbar')
						.remove();

					$(window)
						.off($['mmenu'].keydown);

				}

			};
		}
	])
	.directive('mmenuAuto', function() {
		return function(scope, element, attr) {

			/**
			 * Открытие боковой панели по url-адресу
			 */

			var params = attr.mmenuAuto !== '' ? JSON.parse(attr.mmenuAuto) : {},
				panel = $('#' + (params.panel || 'panel1')),
				mm = $('mmenu-sidebar'),
				ms = $('.mm-slideout');


			if (params.min) {

				mm.addClass('mm-menu-min');
				ms.addClass('mm-slideout-min');

			} else {

				mm.removeClass('mm-menu-min');
				ms.removeClass('mm-slideout-min');

			}

			$(function() {

				if (!mm.hasClass('mm-opened'))
					mm.data('mmenu').open();

				mm.data('mmenu').openPanel(panel);

			});
		}
	})
	.directive('mmenuFocus', ['$timeout',
		function($timeout) {
			return {

				link: function(scope, element) {

					var target = element.get(0).tagName == 'OI-SELECT' ? element.find('input') : element;

					$timeout(function() {
						target.get(0).focus();
					}, 1000);

				}

			}
		}
	])
	.directive('submitPanel', [
		function() {
			return {

				restrict: 'C',

				link: function(scope, element, attrs) {

					element.closest('.mm-panel').get(0).addEventListener('scroll', function() {
						element.get(0).style.bottom = -this.scrollTop + 'px';
					});

				}
			};
		}
	])
	.directive('oiSelect', ['$http', '$q',
		function($http, $q) {
			return {

				restrict: 'E',

				link: function(scope, element, attrs) {

					scope.tags = {
						load: function(url, text) {
							if (text && text.length > 2) {

								var deferred = $q.defer();

								$http
									.get(url +'/'+ text)
									.then(function(response) {
										deferred.resolve(response.data.items);
									});

								return deferred.promise;

							}
						},
						add: function(module, field, text) {

							var deferred = $q.defer();

							$http
								.post(module + '/' + field, {text: text}, {disableErrors: true})
								.then(function(response) {
									deferred.resolve(response.data);
								});

							return deferred.promise;

						},
					};


				}
			};
		}
	])
	.directive('disableEnter', [
		function() {
			return {

				restrict: 'C',

				link: function (scope, element, attrs) {

					element.on('keypress', function(event) {

						if(event.keyCode === 13 || event.which === 13)
							event.preventDefault();

					});

				},

			};
		}
	])
	.directive('fieldResponse', ['$rootScope', '$timeout',
		function($rootScope, $timeout) {
			return {

				restrict: 'C',

				link: function(scope, element, attrs) {

					$rootScope.$on('fillErrors', function(event, errors) {

						var panel = element.closest('.mm-panel');

						element
							.removeClass('has-error')
							.addClass('has-success')
							.find('p.error')
								.remove();

						angular.forEach(errors, function(error) {

							if (error.field == element.find('[ng-model]').attr('ng-model').substring(6))
								element
									.addClass('has-error')
									.removeClass('has-success')
									.append('<p class="error">'+ error.message +'</p>');

						});

						if (errors.length == 1 && errors['0'].field === 'protect') {

							panel
								.find('.go-blur')
									.addClass('blur');

							panel
								.find('.protect-show')
									.show();

							$timeout(function() {

								panel
									.find('.protect-show input')
									.focus();
							}, 600);
						}

					});

				},

			}
		}
	])
	.directive('btnDelete', [
		function() {
			return {

				restrict: 'C',

				link: function(scope, element, attrs) {

					element.bind('click', function() {
						scope.options.request.method = "DELETE";
					});

				},

			};

		}
	])
	.directive('fullPage', [
		function() {
			return {

				restrict: 'C',

				link: function(scope, element, attrs) {

					scope.resize = function() {

						container = $(element)
							.find('.container')
							.get(0);

						button = $(element)
							.find('.btn-add-content')
							.get(0);

						element = $(element)
							.get(0);

						height = window.innerHeight - 50;
						padding = (height - $(container).height()) / 2;

						element.style.height = height + 'px';
						container.style.padding = padding + 'px 0';

						if (button)
							button.style.right = ((window.innerWidth-194)/2) + 'px';

					};

					scope.resize();

					window.addEventListener('resize', function() {
						scope.resize();
					});

				}

			}
		}
	]);