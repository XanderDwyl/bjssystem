<?php

Route::get('/'			  , 'PageController@showIndex');
Route::get('/home'		  , 'PageController@showHome');
Route::get('/about_us'	  , 'PageController@showAbout');
Route::get('/contact_us'  , 'PageController@showContact');
Route::get('/dashboard'	  , 'PageController@showDashboard');

Route::get('/login'	      , 'PageController@showLoginForm');
Route::get('/employee'	  , 'PageController@showEmployeeForm');
Route::get('/salary'	  , 'PageController@showSalary');
Route::get('/payroll'	  , 'PageController@showPayrollForm');
Route::get('/cashadvance' , 'PageController@showCashadvanceForm');

Route::controller('auth'  , 'AuthController');

// consumable API routes
Route::group(array('prefix' => 'api/v1', 'before' => 'api.auth'), function()
{
	Route::resource('employee', 'ApiController');
});

// authentication for api
Route::filter('api.auth', function () {
	if ( !Auth::check() ) {
		return Response::json(array('error' => 'You don\'t have access rights!'), 403);
	}
});


Route::get('routes', function() {
	$routeCollection = Route::getRoutes();

	echo "<table style='width:100%'>";
		echo "<tr>";
			echo "<td width='10%'><h4>HTTP Method</h4></td>";
			echo "<td width='10%'><h4>Route</h4></td>";
			echo "<td width='80%'><h4>Corresponding Action</h4></td>";
		echo "</tr>";
		foreach ($routeCollection as $value) {
			echo "<tr>";
				echo "<td>" . $value->getMethods()[0] . "</td>";
				echo "<td>" . $value->getPath() . "</td>";
				echo "<td>" . $value->getActionName() . "</td>";
			echo "</tr>";


		}
	echo "</table>";
});
