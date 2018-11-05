<!doctype html>
<htmllang="{{ app()->getLocale() }}>
	<head>
		<title>School Management System</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<meta name="_token" content="{{ csrf_token() }}">

		<!-- VENDOR CSS -->
		<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap/css/bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/linearicons/style.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/css/jquery.dataTables.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/datatables/css/dataTables.bootstrap.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/metisMenu/metisMenu.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/parsleyjs/css/parsley.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/toastr/toastr.min.css') }}">
		<link rel="stylesheet" href="{{ URL::asset('vendor/sweetalert/sweetalert.min.css') }}">
		<!-- MAIN CSS -->
		<link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
		<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
		<link rel="stylesheet" href="{{ URL::asset('css/demo.css') }}">
		<!-- GOOGLE FONTS -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
		<!-- ICONS -->
		<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
		<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">

		<script type="text/javascript">
			var baseUrl = '<?=url('');?>';
		</script>		
	</head>

	<body>
		<!-- WRAPPER -->
		<div id="wrapper">
			<!-- NAVBAR -->
			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<div class="navbar-btn">
						<button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu"></i></button>
					</div>
					<!-- logo -->
					<div class="navbar-brand">
						<a href="{{ URL::to('/') }}">School Management System</a>
					</div>
					<!-- end logo -->
					<div class="navbar-right">
					<!-- Right Side Of Navbar -->
						<ul class="nav navbar-nav navbar-right">
							<!-- Authentication Links -->
							@if (Auth::guest())
								<li><a href="{{ route('login') }}">Login</a></li>
								<li><a href="{{ route('register') }}">Register</a></li>
							@else
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
										{{ Auth::user()->name }} <span class="caret"></span>
									</a>

									<ul class="dropdown-menu" role="menu">
										<li>
											<a href="{{ route('logout') }}"
												onclick="event.preventDefault();
														 document.getElementById('logout-form').submit();">
												Logout
											</a>

											<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
												{{ csrf_field() }}
											</form>
										</li>
									</ul>
								</li>
							@endif
						</ul>
					</div>
				</div>
			</nav>
			<!-- END NAVBAR -->
			<!-- LEFT SIDEBAR -->
			<div id="left-sidebar" class="sidebar">
				<button type="button" class="btn btn-xs btn-link btn-toggle-fullwidth">
					<span class="sr-only">Toggle Fullwidth</span>
					<i class="fa fa-angle-left"></i>
				</button>
				<div class="sidebar-scroll">
					<div class="user-account">
					</div>
					<nav id="left-sidebar-nav" class="sidebar-nav">
						<ul id="main-menu" class="metismenu">
@yield('nav_tabs')
						</ul>
					</nav>
					<div style="padding: 30px; text-align: center;">
					</div>
				</div>
			</div>
			<!-- END LEFT SIDEBAR -->
			<!-- MAIN CONTENT -->
			<div id="main-content">
				<div class="container-fluid">
@yield('content')
				</div>
			</div>
			<!-- END MAIN CONTENT -->
			<div class="clearfix"></div>
			<footer>
                <div class="footer navbar-fixed-bottom">
                    <h6 class="copyright pull-right">&copy; 2018<a href="#" target="_blank"></a>. All Rights Reserved.</h6>
                    <br/>
                </div>    
            </footer>
		</div>
		<!-- END WRAPPER -->

<!-- Javascript -->
		<script src="{{ URL::asset('vendor/jquery/jquery.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/metisMenu/metisMenu.js') }}"></script>
		<script src="{{ URL::asset('vendor/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/parsleyjs/js/parsley.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
		<script src="{{ URL::asset('vendor/toastr/toastr.js') }}"></script>
		<script src="{{ URL::asset('vendor/sweetalert/sweetalert.min.js') }}"></script>
		<script src="{{ URL::asset('js/common.js') }}"></script>
@yield('scripts')
	</body>
</html>
