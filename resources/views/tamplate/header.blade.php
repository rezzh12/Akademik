<!DOCTYPE HTML>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('judul')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="freehtml5.co" />

	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content="" />
	<meta property="og:image" content="" />
	<meta property="og:url" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:description" content="" />
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
	

	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">

	<!-- Animate.css -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/owl.carousel.min.css">
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/owl.theme.default.min.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/flexslider.css">

	<!-- Pricing -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/pricing.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="{{asset('AdminLTE')}}/assets/profile/css/style.css">

	<!-- Modernizr JS -->
	<script src="{{asset('AdminLTE')}}/assets/profile/js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="{{asset('AdminLTE')}}//assets/profile/js/respond.min.js"></script>
	<![endif]-->
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{asset('AdminLTE')}}/plugins/summernote/summernote-bs4.min.css">

</head>

<body>

	<div class="fh5co-loader"></div>

	<div id="page" >
		<nav class="fh5co-nav" role="navigation">
		
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-4">
							<div id="fh5co-logo"><a href=""> <img src="images/logo pgri.png" alt="" width="50px" height="50px"> SMK PGRI 2 CIANJUR</a></div>
						</div>
						<div class="col-xs-8 text-right menu-1">
							<ul>
								<li><a href="">Beranda</a></li>
								<li><a href="#fh5co-about">Tentang</a></li>
								<li><a href="#fh5co-blog jurusan">Jurusan</a></li>
								<li><a href="#fh5co-blog">Ekskul</a></li>
                                <li><a href="#fh5co-course-categories">Fasilitas</a></li>
								<li><a href="#location">Lokasi</a></li>
								<li class="btn-cta"><a href="{{ route('login') }}"><span>Login</span></a></li>
							</ul>
						</div>
					</div>

				</div>
			</div>
		</nav>