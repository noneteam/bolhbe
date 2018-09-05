bolhbe
	.directive('sharebutton', ['$location',
		function($location) {

			return function(scope, element, attr) {

				element.on('click', function(event) {

					switch (attr.sharebutton) {
						case 'vkcom':
							url = 'https://vk.com/share.php?url=' + $location.absUrl();
							break;
						case 'facebookcom':
							url = 'https://www.facebook.com/sharer/sharer.php?u=' + $location.absUrl();
							break;
						case 'twittercom':
							url = 'https://twitter.com/intent/tweet?url=' + $location.absUrl();
							break;
					}

					window.open(url,'','toolbar=0,status=0,width=626,height=436');
				});
		}
	}])