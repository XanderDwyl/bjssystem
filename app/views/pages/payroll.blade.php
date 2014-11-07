@section( 'head_wrapper' )
	<html lang="en" ng-app="bjsApp">
@stop
<div id="page-wrapper" ng-controller="employeesController" data-ng-init="init()">
	@{{message}}
	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Payroll System</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-md-5 col-lg-4">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-money"></i>
					List of Payrolls
				</div>
				<div class="list-employee-panel panel-body">
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-md-7 col-lg-8">
			{{ Form::open(array('url' => 'auth/payroll')) }}
				<div class="panel panel-default">
					<div class="panel-heading">
						<i class="fa fa-user"></i>
						Payroll Entry
					</div>
					<div class="add-employee-panel panel-body">
						<form class="form-horizontal" role="form">
							<div class="form-group">
								<label for="inputLName" class="col-sm-4 control-label">Employee Name</label>
								<div class="extend-right">
									<select ng-change="getEmployeeRecord(employee)" ng-model="employee" data-live-search="true" class="sp-employee show-tick show-menu-arrow" data-width="100%" name='employee_id' select-picker="employees">
										<option value="">-- select employee --</option>
										<option ng-repeat="employee in employees" data-subtext="@{{employee.firstname + ' ' + employee.lastname}}">@{{employee.id}}</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">Salary Rate / hr
									<span ng-show="salaryRate" class="label label-success">rate: @{{salaryRate}} per day</span>
									<span ng-show="isSalaryRate" class="label label-warning">Please set salary rate!</span>
								</label>
								<input type="hidden" class="form-control" name="salary_rate" value="@{{salaryRate}}">
								<div class="extend-right">
									<div class='input-group'>
										<input type="text" class="form-control" name="salaryrate" placeholder="0.00" value="@{{salaryperhr.toFixed(2)}}" readonly>
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">Payroll Period</label>
								<div class="extend-right">
									<div class="input-daterange" id="payperiod">
										<div class="input-group">
											<input ng-change="setDaysOfWorked( dateWorked )" ng-model="dateWorked.start" type="text" class="input-small form-control" name="paystart" />
											<span class="input-group-addon">to</span>
											<input ng-change="setDaysOfWorked( dateWorked )" ng-model="dateWorked.end" type="text" class="input-small form-control" name="payend" />
										</div>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">No. of Days Worked</label>
								<div class="extend-right">
									<div class='input-group'>
										<input type="text" class="form-control" name="daysofwork" placeholder="0" value="@{{daysofworked}}" readonly>
										<span class="input-group-addon">
											<i class="fa fa-clock-o"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="col-sm-12">
								<ul class="list-group">
									<li class="list-group-item disabled">Government Agency Contributions / Other Deductions</li>
									<li class="list-group-item list-group-item-info form-group">
										<label class="col-sm-4 control-label">SSS</label>
										<div class="extend-right" id="sss">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-money"></i>
												</span>
												<input ng-change="computeDeduction( deduction )" ng-model="deduction.sss" type="text" class="form-control text-right" name="contribution[sss]" placeholder="0">
											</div>
										</div>
									</li>
									<li class="list-group-item list-group-item-info form-group">
										<label class="col-sm-4 control-label">Pag-ibig</label>
										<div class="extend-right input-group" id="pag-ibig">
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-money"></i>
												</span>
												<input ng-change="computeDeduction( deduction )" ng-model="deduction.pagibig" type="text" class="form-control text-right" name="contribution[pagibig]" placeholder="0">
											</div>
										</div>
									</li>
									<li class="list-group-item list-group-item-info form-group">
										<label class="col-sm-4 control-label">PhilHealth</label>
										<div class='extend-right input-group' id='pag-ibig'>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-money"></i>
												</span>
												<input ng-change="computeDeduction( deduction )" ng-model="deduction.philhealth" type="text" class="form-control text-right" name="contribution[philhealth]" placeholder="0">
											</div>
										</div>
									</li>
									<li class="list-group-item list-group-item-warning form-group">
										<label class="col-sm-4 control-label">Cash Advance Payment</label>
										<div class='extend-right input-group'>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-money"></i>
												</span>
												<input ng-change="computeDeduction( deduction )" ng-model="deduction.capayment" type="text" class="form-control text-right" name="capayment" placeholder="0">
											</div>
										</div>
									</li>
									<li class="list-group-item list-group-item-danger form-group">
										<label class="col-sm-4 control-label" leave-plurality></label>
										<div class='extend-right input-group'>
											<div class="input-group">
												<span class="input-group-addon">
													<i class="fa fa-clock-o"></i>
												</span>
												<input ng-change="computeDeduction( deduction )" type="text" class="form-control text-right" ng-model="deduction.leave" name="leavedhours" placeholder="0">
											</div>
										</div>
									</li>
								</ul>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">Total Deductions</label>
								<div class="extend-right">
									<div class='input-group'>
										<input type="text" class="form-control" name="totaldeductions" placeholder="0.00" value="@{{totalDeduction.toFixed(2)}}" readonly>
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">Sub-Total Income</label>
								<div class="extend-right">
									<div class='input-group'>
										<input type="text" class="form-control" name="subtotal" placeholder="0.00" value="@{{subtotal.toFixed(2)}}" readonly>
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
								</div>
							</div>
							<div class="form-group">
								<label for="inputSalary" class="col-sm-4 control-label">Net Income</label>
								<div class="extend-right">
									<div class='input-group'>
										<input type="text" class="form-control" name="netincome" placeholder="0.00" value="@{{netincome.toFixed(2)}}" readonly>
										<span class="input-group-addon">
											<i class="fa fa-money"></i>
										</span>
									</div>
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
