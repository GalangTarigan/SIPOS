<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<meta name="csrf-token" content="{{csrf_token()}}"/>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-touch-fullscreen" content="yes">
	<meta name="description" content="Avenger Admin Theme">

	<link href="https://fonts.googleapis.com/css?family=Poppins&display=swap" rel="stylesheet">

	{{-- <link rel="shortcut icon" href="https://www.nakulasadewa.com/wp-content/uploads/2017/08/KiosK-Mesin-Antrian.png" type="image/x-icon"> --}}
	<link type="text/css" href="{{asset('fonts/font-awesome/css/all.css')}}" rel="stylesheet">
	<!-- Font Awesome -->

	<link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
	<!-- Font Iconic-->
	
	<link type="text/css" href="{{asset('css/styles.css')}}" rel="stylesheet"> <!-- Core CSS with all styles -->

	<link type="text/css" href="{{asset('plugins/jstree/dist/themes/avenger/style.min.css')}}" rel="stylesheet">
	<!-- jsTree -->
	<link type="text/css" href="{{asset('plugins/codeprettifier/prettify.css')}}" rel="stylesheet">
	<!-- Code Prettifier -->
	<script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!}
    </script>    
	@yield('css')

	<title>Skripsi</title>

</head>

<body class="infobar-overlay">


	<div id="wrapper">
		<div id="layout-static">			
			<div class="static-content-wrapper">
				@yield('content')
				<footer role="contentinfo">
					<div class="clearfix">
						<ul class="list-unstyled list-inline pull-left">
							<li>
								<h6 style="margin: 0;"> &copy; 2020 INDAH ELEKTRONIK</h6>
							</li>
						</ul>
						<button class="pull-right btn btn-link btn-xs hidden-print" id="back-to-top"><i
								class="fa fa-arrow-up"></i></button>
					</div>
				</footer>
			</div>
		</div>
	</div>
	<!-- Load site level scripts -->
	<script type="text/javascript" src="{{asset('js/jquery-3.4.1.js')}}"></script>		<!-- Load jQuery -->
	<script type="text/javascript" src="{{asset('js/jquery-ui.js')}}"></script> 	<!-- Load jQueryUI -->
    <script type="text/javascript" src="{{asset('js/bootstrap.js')}}"></script> 		<!-- Load Bootstrap -->
	<script type="text/javascript" src="{{asset('plugins/jstree/dist/jstree.min.js')}}"></script>		 <!-- jsTree -->
	<script type="text/javascript" src="{{asset('plugins/codeprettifier/prettify.js')}}"></script>		<!-- Code Prettifier  -->
	<script type="text/javascript" src="{{asset('plugins/bootstrap-switch/bootstrap-switch.js')}}"></script>	<!-- Swith/Toggle Button -->
	<script type="text/javascript" src="{{asset('plugins/bootstrap-tabdrop/js/bootstrap-tabdrop.js')}}"></script>	<!-- Bootstrap Tabdrop -->
	<script type="text/javascript" src="{{asset('js/enquire.min.js')}}"></script>		 <!-- Enquire for Responsiveness -->
	<script type="text/javascript" src="{{asset('plugins/bootbox/bootbox.js')}}"></script> 		<!-- Bootbox -->
	<script type="text/javascript" src="{{asset('plugins/nanoScroller/js/jquery.nanoscroller.min.js')}}"></script>		<!-- nano scroller for multiple level-->
	<script type="text/javascript" src="{{asset('plugins/jquery-mousewheel/jquery.mousewheel.min.js')}}"></script>	<!-- Mousewheel support needed for jScrollPane -->
	<script type="text/javascript" src="{{asset('js/application.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/app.js')}}"></script>
	<!--notifications prequisite script-->
	<script type="text/javascript" src="{{ asset('demo/notifications-alert-admin.js') }}"></script>
	<!-- notifications -->
	<script type="text/javascript" src="{{ asset('js/sweetalert2.all.js') }}"></script>
	<script type="text/javascript" src="{{asset('plugins/moment/moment-with-locales.js')}}"></script>
	<!--Moment JS-->							
	@yield('script')

	

</body>

</html>