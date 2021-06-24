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
    @if(!auth()->guest())
        <script>
            window.Laravel.userId = {!! auth()->user()->id !!}
        </script>
    @endif
	@yield('css')

	<title>Skripsi</title>

</head>

<body class="infobar-overlay">
	<input id="id-kasir" type="hidden" value="{{Auth::user()->id}}">
	<header id="topnav" class="navbar navbar-default navbar-fixed-top clearfix" role="banner">

		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			<a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar"><span class="icon-bg"><i
						class="fa fa-fw fa-bars"></i></span></a>
		</span>

		<span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
			
		</span>

		<ul class="nav navbar-nav toolbar pull-right">
			<li>
				<button class="btn btn-default-alt col-sm-12" type="button" onclick=" window.location.href = '/kasir/lihat-info-garansi-kasir'" style="margin-top: 8px"><i
					class="fa fa-search"></i>&nbsp; Lihat Info Garansi</button>
			</li>
		{{-- <li  class="dropdown toolbar-icon-bg"> --}}
						{{-- <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i data-count="0	" class="fa fa-fw fa-bell"></i></span></a> --}}
						{{-- <a href="#" class="dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i data-count="0	" class="fa fa-fw fa-bell"></i></span></a>
						<div class="dropdown-menu dropdown-alternate notifications arrow">
							<div class="dd-header">
								<span>Notifikasi</span>
							</div> --}}
							{{-- <div class="scrollthis scroll-pane">
								<ul id="notificationsWrapper" class="scroll-content">
								</ul>
							</div>
							<div class="dd-footer">
								<a href="{{route('notifikasiAdmin')}}">Lihat Semua Notifikasi</a>
							</div> --}}
						{{-- </div>
					</li> --}}

				<li class="dropdown toolbar-icon-bg" style="padding-right: 8px;">
						<a href="" class="dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i
									class="fas fa-fw fa-cog"></i></span></a>
						<ul class="dropdown-menu userinfo arrow">
							<li><a href="{{route('profileKasir')}}"><span class="pull-left">Profile</span> <i class="pull-right fa fa-user"></i></a>
							</li>
					<li class="divider"></li>
							<li><a href="{{route('gantiPassword')}}"><span class="pull-left">Ganti Password</span> <i class="pull-right fas fa-unlock-alt"></i></a>
							</li>
							
					<li class="divider"></li>
					<li><a href="{{route('logoutKasir') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="pull-left">Logout</span>
						<i class="pull-right fa fa-sign-out-alt"></i></a>
								<form id="logout-form" action="{{route('logoutKasir')}}" method="POST" style="display: none;">
									@csrf
								</form>
							</li>
						</ul>
				</li>

		</ul>
		
	</header>

	<div id="wrapper">
		<div id="layout-static">
			<div class="static-sidebar-wrapper sidebar-midnightblue">
				<div class="static-sidebar">
					<div class="sidebar">
						<div class="widget stay-on-collapse" id="widget-welcomebox">
							<div class="widget-body welcome-box tabular">
								<div class="tabular-row">
									<div class="tabular-cell welcome-avatar">
										@if(Auth::user()->foto)
											<a href="{{route('profileKasir')}}">
												<div class="img-circular-small" style="background-image: url({{ request()->getSchemeAndHttpHost() }}/kasir/akun/profile/get-userImage-kasir/?filename={{Auth::user()->foto}})"></div>
											</a>	
											@else
											<a href="{{route('profileKasir')}}">
												<div class="img-circular-small" style="background-image: url(https://www.pngkey.com/png/full/202-2024792_user-profile-icon-png-download-fa-user-circle.png)"></div>
											</a>
											@endif
									</div>
									<div class="tabular-cell welcome-options">
										<span class="welcome-text" style="margin-top: -8%">Welcome,</span>
									<a href="{{route('profileKasir')}}" class="name">{{ Auth::user()->nama_lengkap }}</a>
									<span class="welcome-text" style="margin-bottom: -20%"> As {{ Auth::user()->role }}</span>
									</div>
								</div>
							</div>
						</div>
						<div class="widget stay-on-collapse" id="widget-sidebar">
							<nav role="navigation" class="widget-body">
								<ul class="acc-menu">
									<li class="nav-separator"></li>
									<li><a href="{{route('dashboardKasir')}}"><i class="fa fa-home"></i><span>Dashboard</span></a></li>
									<li class="nav-separator">Kasir</li>
									<li><a href="javascript:;"><i class="fa fa-shopping-cart "></i><span>Transaksi Penjualan</span><span class="badge badge-primary"></span></a>
                                        <ul class="acc-menu">
											<li><a href="{{route('formKasir-kasir')}}">Kasir</a></li>
											<li><a href="{{route('historyKasir-kasir')}}">Histori Transaksi</a></li>									
                                        </ul>
									</li>
									<li class="nav-separator">Manajement</li>
									<li><a href="javascript:;"><i class="fa fa-archive"></i><span>Stock Barang</span><span class="badge badge-primary"></span></a>
                                        <ul class="acc-menu">
											<li><a href="{{route('showDaftarBarangKasir')}}">Daftar Barang</a></li>									
											<li><a href="{{route('showKategoriKasir')}}">Kategori & Merk Barang</a></li>
											<li><a href="{{route('formTambahBarangKasir')}}">Tambah Barang Baru</a></li>									
                                        </ul>
									</li>

									<li><a href="javascript:;"><i class="fa fa-wrench"></i><span>Barang Service</span><span class="badge badge-primary"></span></a>
                                        <ul class="acc-menu">
											<li><a href="{{route('showDaftarBarangService-kasir')}}">Daftar Service</a></li>									
											<li><a href="{{route('formAddBarangService-kasir')}}">Buat Catatan Service</a></li>
                                        </ul>
									</li>

									<li><a href="javascript:;"><i class="fa fa-spinner"></i><span>Barang Return</span><span class="badge badge-primary"></span></a>
                                        <ul class="acc-menu">
											<li><a href="{{route('showDaftarBarangReturn-kasir')}}">Daftar Barang Return</a></li>
											<li><a href="{{route('showTambahBarangReturn-kasir')}}">Tambah Barang Return</a></li>									
                                        </ul>
									</li>

									<li><a href="javascript:;"><i class="fa fa-user-plus"></i><span>Pegawai</span><span class="badge badge-primary"></span></a>
                                        <ul class="acc-menu">
										<li><a href="{{route('showPegawaiKasir')}}">Daftar Pegawai</a></li>
                                        </ul>
									</li>
							
									<li class="nav-separator"></li>
									<li><a href="{{route('statistikPenjualan-kasir')}}"><i class="fa fa-chart-line"></i><span>Statistik Penjualan</span></a></li>

									<li class="nav-separator"></li>
									<li><a onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out-alt"></i><span>Logout</span></a>
										<form id="logout-form" action="{{route('logoutKasir')}}" method="POST" style="display: none;">
											@csrf
										</form>
									</li>
								</ul>
							</nav>
						</div>
					</div>
				</div>
			</div>
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