'use strict';

angular.module('services', ['angularMoment'])
	.factory('Employees', function($http) {
		return {
			get : function( query ) {
				return $http.get('/api/v1/employee/' + query);
			},
			create : function( data ) {
				return $http.post('/api/v1/employee/', data);
			},
			delete : function(id) {
				return $http.delete('/api/v1/employee/' + id);
			}
		};
	} )
	.factory('DaysWorked', function() {
		return {
			count : function ( dateworked ) {
				var dateStart = moment(dateworked.start || 0);
				var dateEnd   = moment(dateworked.end || dateStart);

				return dateworked && dateEnd.diff(dateStart, 'days') + 1 || 0;
			}
		};
	} );
