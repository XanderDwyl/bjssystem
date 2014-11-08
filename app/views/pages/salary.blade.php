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
		<ol class="list-group col-sm-12" ng-include="template.urlData">
		</ol>
	</div>
</div>

@section( 'footer' )
	<div class="container">
		<span>Don't want to register a user? </span>
		<a href="users/register" class="btn btn-black">Register</a>
	</div>
@stop
