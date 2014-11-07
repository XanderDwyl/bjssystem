@section( 'head_wrapper' )
	<html>
@stop
<div id="login-wrapper">
	{{ Form::open(array('url' => 'auth/login','class' => 'form login-form')) }}
		<legend>Sign in to <span class="text-primary">BJS Admin</span></legend>
		<div class="login-body">
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-user"></i></span>
				<input type="text" class="form-control" name="email" placeholder="Username">
			</div>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-lock"></i></span>
				<input type="password" class="form-control" name="password" placeholder="Password">
			</div>
		</div>
		<div class="login-footer">
			<input type="checkbox" value="option1"> <span>Remember me</span></input>
			<button type="submit" class="btn btn-success">Login</button>
		</div>
	{{ Form::close() }}
</div>
