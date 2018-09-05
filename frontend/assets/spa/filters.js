bolhbe
	.filter('integerToReadable', function() {
		return function(count, form) {

			if (count) {
				count100 = Math.abs(count) % 100;
				count10 = count % 10;

				if (count100 >= 11 && count100 <= 19)
					return count + form['2'];
				if (count10 >= 2 && count10 <= 4)
					return count + form['1'];
				if (count10 == 1)
					return count + form['0'];
			}

			return (count||0) + form['2'];

		};
	})
	.filter('tagsHelper', function() {
		return function(array, form = false) {

			var output = form ? [] : '';

			angular.forEach(array, function(object) {
				if (form) output.push(object.position);
				else {
					angular.forEach(object, function(value, key) {
						angular.forEach(value, function(value, key) {

							if (output.length && key == 'text')
								output += ', ';

							if (key == 'text')
								output += value;

						})
					});
				}
			});

			return output;

		};
	})
	.filter('phone', function() {
		return function(phone) {

			if (!phone) return '';

			var value = phone.toString().trim().replace(/^\+/, '');

			var city = value.slice(0, 3),
				number = value.slice(3);

			number = number.slice(0, 3) + ' ' + number.slice(3,5) +' '+ number.slice(5,7);

			return ("(" + city + ") " + number);

		};
	});