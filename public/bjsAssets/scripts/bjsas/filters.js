'use strict';

angular.module('filters', [])
	.filter('dateFormat', function($filter) {
		return function(input)
		{
			if( input === null ) { return; }

			return $filter('date')(new Date(input), 'MM/dd/yyyy').toUpperCase();
		};
	});
