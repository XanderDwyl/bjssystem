'use strict';

angular.module('directives', [])
	.directive('selectPicker', ['$timeout',
		function($timeout) {
			return {
				restrict: 'A',
				//added attribute
				link: function(scope, elem, attr) {
					$timeout(function() {
						elem.selectpicker({
							howSubtext: true
						});
					}, 10);

					scope.$watch(attr.selectPicker, function(newValue, oldValue) {
						if (newValue === oldValue) {
							return;
						}

						$timeout(function() {
							elem.selectpicker('refresh');
						}, 100);
					} );
				}
			};
		}
	] )
	.directive('leavePlurality', function () {
		return {
			template : 'Total no. of hour{{label.leave}} on leave'
		};
	} );
