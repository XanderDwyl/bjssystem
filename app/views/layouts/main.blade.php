<!DOCTYPE html>
@yield( 'head_wrapper' )
<head>
	<meta charset="utf-8">
	<title>BJS MotoShop</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="We sell motorcycle parts while we modified to works for your needs.">
	<meta name="author" content="BJS MotoShop">

	{{ HTML::style( 'packages/bootstrap/dist/css/bootstrap.css' ) }}
	{{ HTML::style( 'packages/font-awesome/css/font-awesome.css' ) }}
	{{ HTML::style( 'bjsAssets/css/main.css' ) }}
	{{ HTML::style( 'bjsAssets/css/plugins/date-picker/datepicker.css' ) }}
	{{ HTML::style( 'packages/bootstrap-select/dist/css/bootstrap-select.css' ) }}

</head>
<body>
	<div class="navbar navbar-default navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/home">BJS MotoShop</a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav navbar-left">
					@if(Auth::check())
						<li><a href="/dashboard">Dashboard</a></li>
						<li><a href="/pos">POS System</a></li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">Accounting System <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="payroll">Payroll</a></li>
								<li><a href="cashadvance">Cash Advance</a></li>
								<li class="divider"></li>
								<li><a href="employee">Add Employee</a></li>
							</ul>
						</li>
					@endif
				</ul>
				<ul class="nav navbar-nav navbar-right">
					@if(!Auth::check())
						<li>{{ HTML::link('login', 'Login') }}</li>
					@else
						<li class="dropdown user-dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-user"></i> {{ Auth::user()->getAuthUserName() }} <b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> Inbox <span class="badge">7</span></a></li>
								<li><a href="#"><i class="fa fa-gear"></i> Settings</a></li>
								<li class="divider"></li>
								<li><a href="auth/logout"><i class="fa fa-power-off"></i> Log Out</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</div>

	<div class="container">
		{{-- */$status='danger';/* --}}

		@if ( !count($errors ) )
			{{-- */$status=Session::get( 'status' );/* --}}
		@endif

		@if ( count($errors ) || count(Session::get( 'status' )) )
			<div class="alert alert-{{ $status }} alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert">
				<span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				@if ( count($errors) )
					<span>{{ 'Sorry, I can\'t proceed with errors! This useful information is highly needed.' }}</span>
				@else
					<span>{{ Session::get( 'message' ) }}</span>
				@endif
			</div>
		@endif

		{{ $content }}
	</div>

	<div class="footer">
		@yield( 'footer' )
	</div>

	@section( 'script_files' )
		{{ HTML::script( 'bjsAssets/scripts/jquery-1.10.2.js' ) }}
		{{ HTML::script( 'packages/bootstrap/dist/js/bootstrap.js' ) }}
		{{ HTML::script( 'bjsAssets/scripts/plugins/date-picker/bootstrap-datepicker.js' ) }}
		<!-- angular packages -->
		{{ HTML::script( 'packages/angular/angular.js' ) }}
		{{ HTML::script( 'packages/angular-sanitize/angular-sanitize.js' ) }}
		{{ HTML::script( 'packages/angular-route/angular-route.js' ) }}
		{{ HTML::script( 'packages/underscore/underscore.js' ) }}
		{{ HTML::script( 'packages/moment/moment.js' ) }}
		{{ HTML::script( 'packages/moment-range/lib/moment-range.js' ) }}
		{{ HTML::script( 'packages/angular-moment/angular-moment.js' ) }}

		{{ HTML::script( 'bjsAssets/scripts/bjsas/controllers.js' ) }}
		{{ HTML::script( 'bjsAssets/scripts/bjsas/services.js' ) }}
		{{ HTML::script( 'bjsAssets/scripts/bjsas/directives.js' ) }}
		{{ HTML::script( 'bjsAssets/scripts/bjsas/app.js' ) }}

		{{ HTML::script( 'packages/bootstrap-select/dist/js/bootstrap-select.js' ) }}
		@yield( 'footer_scripts' )
	@show
</body>
<script type="text/javascript">
    $(function () {
		angular.module("bjsApp").constant("CSRF_TOKEN", '<?php echo csrf_token(); ?>');

    	var formatTwo = function ( ) {
    		return ( arguments[ 0 ] < 10 ) ? '0' + arguments[0] : arguments[0];
    	}

    	var today = new Date();
		var yr = today.getFullYear() - 18;
		var dt = today.getDate();
		var mt = today.getMonth();
    	var legalAgeDate = formatTwo( mt ) + '/' + formatTwo( dt ) + '/' + yr;
    	var toDate = formatTwo( mt + 1 ) + '/' + formatTwo( dt ) + '/' + today.getFullYear();


    	$('#birthDate').attr( 'placeholder', legalAgeDate );
    	$('#date_released, #hiredDate').attr( 'placeholder', toDate );

        $('.input-group.date').datepicker( {
        	todayHighlight : true,
        	todayBtn       : true,
        	orientation    : 'top left',
        	format         : 'mm/dd/yyyy'
        } );

        $("[data-toggle='tooltip']").tooltip( 'show' );

        $(".sp-employee").selectpicker({
        	'size' : 10
        });

        $('#payperiod').datepicker( { } );
    });

</script>
</html>
