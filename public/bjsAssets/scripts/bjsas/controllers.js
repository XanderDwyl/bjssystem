'use strict';

angular.module('controllers', ['angularMoment'])
	.controller('employeesController', function($scope, $http, Employees, DaysWorked) {
		$scope.totalDeduction = 0;
		$scope.daysofworked   = 0;
		$scope.label          = [];

		$scope.init = function () {
			Employees.get().then( function( response, status) {
				$scope.employees = response.data;
			} );
		};

		$scope.getEmployeeRecord = function( query ) {
			Employees.get( query )
				.then( function( response, status) {
					$scope.salaryperhr  = '';
					$scope.salaryRate   = 0;
					$scope.isSalaryRate = 0;
					if( response.data['salary_rates'].length > 0 ) {
						$scope.salaryRate = response.data['salary_rates'][ 0 ].amount;
						$scope.salaryperhr = ($scope.salaryRate || 0) / 8;
					} else {
						$scope.isSalaryRate = 1;
					}

					if ( !$scope.daysofworked ) {
						$scope.setDaysOfWorked( null );
					} else {
						$scope.computeSalary();
					}
				} );
		};

		$scope.leaveLabel = function ( deduction ) {
			$scope.updateLabel( 'leave', deduction );
		};

		$scope.updateLabel = function ( attr, options ) {
			$scope.label[attr] = options.leave > 1 && 's' || '';
		};

		$scope.computeDeduction = function ( deduction ) {
			var leaveDeduction = parseFloat( deduction.leave || 0 ) * parseFloat( $scope.salaryperhr || 0 );

			$scope.leaveLabel( deduction );
			$scope.totalDeduction = parseFloat( deduction.sss || 0 ) +
									parseFloat( deduction.pagibig || 0) +
									parseFloat( deduction.philhealth || 0) +
									parseFloat( deduction.capayment || 0) +
									parseFloat( leaveDeduction );

			$scope.computeSalary();
		};

		$scope.setDaysOfWorked = function ( dateWorked ) {
			dateWorked = dateWorked || 0;
			$scope.daysofworked = DaysWorked.count( dateWorked );
			$scope.computeSalary();
		};

		$scope.computeSalary = function () {
			$scope.workedinhr = parseInt($scope.daysofworked, 10) * 8;
			$scope.subtotal   = $scope.workedinhr * $scope.salaryperhr;
			$scope.netincome  = $scope.subtotal - $scope.totalDeduction;
		};

	} )
	.controller('salaryController', function($scope, $http, Employees ) {
		$scope.init = function () {
			Employees.get().then( function( response, status) {
				$scope.salary_rate = response.data;


			} );
		};
	} );
