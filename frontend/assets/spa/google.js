(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

bolhbe
	.run(['$rootScope', '$window', '$location',
		function($rootScope,  $window, $location) {

			angular.forEach(document.getElementsByTagName('meta'), function(value, key) {

				if (value.getAttribute('name') === 'analytics' && value.getAttribute('state') === 'true') {

					$window.ga('create', 'UA-27145550-2', 'auto');

					$rootScope.$on('$stateChangeSuccess', function() {

						setTimeout(function() {
							$window.ga('send', 'pageview', $location.path());
						}, 0);

					});

				}

			});

		}
	]);