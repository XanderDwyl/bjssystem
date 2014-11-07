@section( 'head_wrapper' )
	<html lang="en" ng-app="app">
@stop
<div id="page-wrapper" ng-controller="salaryController" data-ng-init="init()">
	@{{message}}
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Salary Rate Info</h1>
		</div>
	</div>
	<div class="row">
		<ul class="col-sm-12">
			<li ng-repeat="rate in salary_rate">
				@{{rate.employee}} @{{rate.salary}}
			</li>
		</ul>
	</div>
</div>

@section( 'footer' )
	<div class="container">
		<span>Don't want to register a user? </span>
		<a href="users/register" class="btn btn-black">Register</a>
	</div>
@stop
