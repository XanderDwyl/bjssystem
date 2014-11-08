@section( 'head_wrapper' )
	<html lang="en" ng-app="bjsApp">
@stop
<div id="page-wrapper" ng-controller="salaryController" data-ng-init="init()">
	@{{message}}
	<div class="row">
		<div class="col-lg-12 page-header">
			<h1 class="col-xs-10">Employees</h1>
			<button type="button" class="col-xs-1 btn btn-primary">Add Entry</button>
		</div>
	</div>
	<div class="row container">
		<ol class="list-group col-sm-12">
			<li class="list-group-item hidden-xs">
				<div class="row list-group-item-heading text-uppercase text-center">
					<h5 class="col-xs-3 col-sm-2 col-md-1 text-center">Id</h5>
					<h5 class="col-xs-10 col-sm-3 col-md-3">Employee</h5>
					<h5 class="col-xs-10 col-sm-3 col-md-4">Address</h5>
					<h5 class="col-xs-10 col-sm-1 col-md-2">Rate</h5>
					<h5 class="col-xs-10 col-sm-1 col-md-1 ">Hired Date</h5>
					<h5 class="col-xs-1">Action</h5>
				</div>
			</li>
			<li class="list-group-item" ng-repeat="rate in salary_rate">
				<div class="row text-center">
					<div class="col-xs-10 col-sm-2 col-md-1">@{{rate.id}}</div>
					<div class="col-xs-10 col-sm-3 col-md-3">@{{rate.firstname + ' ' + rate.lastname}}</div>
					<div class="col-xs-10 col-sm-3 col-md-4">@{{rate.home_address}}</div>
					<div class="col-xs-10 col-sm-1 col-md-2">@{{rate.salary_rates[0].amount | currency : 'Php ' : 2 }}</div>
					<div class="col-xs-10 col-sm-1 col-md-1">@{{rate.hired_date | dateFormat}}</div>
					<div class="col-xs-1"><i class="fa fa-minus-circle text-danger"></i></div>
				</div>
			</li>
		</ol>
	</div>
</div>

@section( 'footer' )
	<div class="container">
		<span>Don't want to register a user? </span>
		<a href="users/register" class="btn btn-black">Register</a>
	</div>
@stop
