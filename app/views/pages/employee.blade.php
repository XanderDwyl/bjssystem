@section( 'head_wrapper' )
	<html lang="en">
@stop
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Employees Information</h1>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-users"></i>
					List of Employees
					<div class="btn-group pull-right">
						<button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-chevron-down"></i>
						</button>
						<ul class="dropdown-menu slidedown">
							<li>
								<a href="#">
									<i class="fa fa-check-circle fa-fw"></i> Regular
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">
									<i class="fa fa-check-circle fa-fw"></i> Probitionary
								</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="#">
									<i class="fa fa-times fa-fw"></i> Resigned
								</a>
							</li>
						</ul>
					</div>
				</div>
				<div class="list-employee-panel panel-body">

				@foreach( $employees as $employee )
					<div class="media">
						<img src="http://placehold.it/50/55C1E7/fff" alt="User Avatar" class="media-avatar img-thumbnail" />
						<div class="media-body">
							<h4 class="media-heading">{{ $employee->firstname . ' ' . $employee->lastname }}</h4>
							<span class="media-group">
								<label class="col-sm-5">Salary Rate :</label>
								<label class="col-sm-7 control-data">{{ 'Php ' . $employee->amount }}</label>
							</span>
						</div>
					</div>
					<div class="divider"></div>
				@endforeach
				</div>
				<div class="panel-footer">
					<div class="input-group">
						<input id="btn-input" type="text" class="form-control input-sm" placeholder="Search Employee..." />
						<span class="input-group-btn">
							<button class="btn btn-warning btn-sm" id="btn-list">
								Search
							</button>
						</span>
					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-7 col-lg-8">
			{{ Form::open(array('url' => 'auth/employee')) }}
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user"></i>
						Add New Employee
					</div>
					<div class="add-employee-panel panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="inputLName" class="col-sm-3 control-label">Last Name</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('lastName') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="extend-right {{ $err_status }}" {{ $errors->first('lastName','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
									<input type="text" class="form-control" id="inputLName" name="lastName" placeholder="Dagohoy" value="{{ Input::old('lastName') }}">
								</div>
							</div>
							<div class="form-group">
								<label for="inputFName" class="col-sm-3 control-label">First Name</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('firstName') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="extend-right {{ $err_status }}" {{ $errors->first('firstName','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
									<input type="text" class="form-control" id="inputFName" name="firstName" placeholder="Ponso" value="{{ Input::old('firstName') }}">
								</div>
							</div>
							<div class="form-group">
								<label for="inputAddress" class="col-sm-3 control-label">Home Address</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('homeAddress') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="extend-right {{ $err_status }}" {{ $errors->first('homeAddress','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
									<input type="address" class="form-control" id="inputAddress" name="homeAddress" placeholder="6000 Cebu City, Philippines" value="{{ Input::old('homeAddress') }}">
								</div>
							</div>
							<div class="form-group">
								<label for="inputGender" class="col-sm-3 control-label">Gender</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('gender') )
									{{--*/$err_status='has-error'/*--}}
								@endif

								<div class="col-sm-4 {{ $err_status }}" {{ $errors->first('gender','data-toggle="tooltip" data-placement="right" title=":message"') }}>
									<div class="input-group btn-group btn-group-sm btn-gender" data-toggle="buttons">
										{{--*/$checked=''/*--}}
										{{--*/$gender=''/*--}}
										@if ( Input::old('gender')=='Male' )
											{{--*/$checked='checked'/*--}}
											{{--*/$gender='active'/*--}}
										@endif
										<label class="btn btn-default {{ $gender }}"><input type="radio" name="gender" value="Male" {{ $checked }}>Male</label>
										{{--*/$checked=''/*--}}
										{{--*/$gender=''/*--}}
										@if ( Input::old('gender')=='Female' )
											{{--*/$checked='checked'/*--}}
											{{--*/$gender='active'/*--}}
										@endif
										<label class="btn btn-default {{ $gender }}"><input type="radio" name="gender" value="Female" {{ $checked }}>Female</label>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="birthdate" class="col-sm-3 control-label">Date of Birth</label>
							    {{--*/$err_status=''/*--}}
								@if ( $errors->has('birthDate') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-4 {{ $err_status }}" {{ $errors->first('birthDate','data-toggle="tooltip" data-placement="right" title=":message"') }}>
							    	<div class="input-group date" id="birthdatepicker">
										<input class="form-control" type="text" id="birthDate" name="birthDate" value="{{ Input::old('birthDate') }}">
										<span class="input-group-addon no-select"><i class="fa fa-calendar"></i></span>
									</div>
							    </div>
							</div>
							<div class="form-group">
								<label for="birthdate" class="col-sm-3 control-label">Hired Date</label>
							    {{--*/$err_status=''/*--}}
								@if ( $errors->has('hiredDate') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-4 {{ $err_status }}" {{ $errors->first('hiredDate','data-toggle="tooltip" data-placement="right" title=":message"') }}>
							    	<div class="input-group date" id="birthdatepicker">
										<input class="form-control" type="text" id="hiredDate" name="hiredDate" value="{{ Input::old('hiredDate') }}">
										<span class="input-group-addon no-select"><i class="fa fa-calendar"></i></span>
									</div>
							    </div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-3 control-label">Salary Rate</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('salary') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-4 {{ $err_status }}" {{ $errors->first('salary','data-toggle="tooltip" data-placement="right" title=":message"') }}>
									<div class='input-group' id='salaryrate'>
										<input type="salary" class="form-control" id="inputSalary" name="salary" placeholder="0.00" value="{{ Input::old('salary') }}">
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
								</div>
							</div>
							<!-- <div class="photo form-control text-center">
								<i class="fa fa-user"></i>
							</div> -->
						</form>
					</div>
					<div class="panel-footer">
						<div class="input-group text-right">
							<button type="submit" class="btn btn-success no-select">Save Employee</button>
						</div>
					</div>
				</div>
			{{ Form::close() }}
		</div>
	</div>
</div>

@section( 'footer' )
	<div class="container">
		<span>Don't want to register a user? </span>
		<a href="users/register" class="btn btn-black">Register</a>
	</div>
@stop
