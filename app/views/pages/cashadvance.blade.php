@section( 'head_wrapper' )
	<html lang="en">
@stop
<div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Employees Cash Advance</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-money"></i>
					Cash on Hand
				</div>
				<div class="list-employee-panel panel-body">
					<div class="media">
						<div class="media-body width-100 text-center">
							<h2>Php {{ number_format(0, 2, '.', ', ') }}</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-money"></i>
					Total Cash Advance - Collectable
				</div>
				<div class="list-employee-panel panel-body">
					<div class="media">
						<div class="media-body width-100 text-center">
							<h2>Php {{ number_format($totalCollectable, 2, '.', ', ') }}</h2>
						</div>
					</div>
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-money"></i>
					List of Cash Advances
				</div>
				<div class="list-employee-panel panel-body">
					@foreach( $cashtransactions as $cashtransaction )
						<div class="media">
							<div class="media-body width-100">
								{{ $cashtransaction->firstname . ' ' . $cashtransaction->lastname . ' - Php ' . number_format($cashtransaction->amount, 2, '.', ', ') }}
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-7 col-lg-8">
			{{ Form::open(array('url' => 'users/savecashadvance')) }}
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user"></i>
						Cash Advance Entry
					</div>
					<div class="add-employee-panel panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="inputLName" class="col-sm-3 control-label">Employee</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('employee_id') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-9 {{ $err_status }}" {{ $errors->first('employee_id','data-toggle="tooltip" data-placement="top-left" title=":message"') }}>
									<select class="sp-employee show-tick show-menu-arrow" data-width="100%" name='employee_id'>
										<option value='0' selected disabled>Please select employee.</option>
										@foreach( $employees as $employee )
											<option value="{{ $employee->emp_id }}"{{ $employee->emp_id!=Input::old('employee_id') ? ' ' : 'selected="selected"'}}>
												{{ '[ ' . $employee->emp_id . ' ] ' . $employee->firstname . ' ' . $employee->lastname}}
											</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-3 control-label">Cash Advance</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('amount') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-9 {{ $err_status }}" {{ $errors->first('amount','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
									<div class='input-group' id='salaryrate'>
										<input type="text" class="form-control" id="inputSalary" name="amount" placeholder="0.00" value="{{ Input::old('amount') }}">
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="birthdate" class="col-sm-3 control-label">Released Date</label>
							    {{--*/$err_status=''/*--}}
								@if ( $errors->has('releasedDate') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-9 {{ $err_status }}" {{ $errors->first('releasedDate','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
							    	<div class="input-group date" id="releasedDatepicker">
										<input class="form-control" type="text" id="releasedDate" name="releasedDate" value="{{ Input::old('releasedDate') }}">
										<span class="input-group-addon no-select"><i class="fa fa-calendar"></i></span>
									</div>
							    </div>
							</div>
							<div class="form-group">
								<label for="inputAddress" class="col-sm-3 control-label">Received By</label>
								{{--*/$err_status=''/*--}}
								@if ( $errors->has('received_by') )
									{{--*/$err_status='has-error'/*--}}
								@endif
								<div class="col-sm-9 {{ $err_status }}" {{ $errors->first('received_by','data-toggle="tooltip" data-placement="bottom-left" title=":message"') }}>
									<input type="text" class="form-control" id="received_by" name="received_by" placeholder="named who received the money" value="{{ Input::old('received_by') }}">
								</div>
							</div>

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