@yield('content')
<footer id="footer" role="contentinfo" style="height:100px; background-color:black;">
	<div class="overlay"></div>
	

		<div class="row copyright">
			<div class="col-md-12 text-center">
				<p style="padding-top:40px;">
					<small class="block">&copy; 2024 SMK PGRI 2 CIANJUR. All Rights Reserved.</small>
				</p>
			</div>
		</div>

	</div>
</footer>
</div>

<div class="gototop js-top">
	<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.min.js"></script>
<!-- jQuery Easing -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.easing.1.3.js"></script>
<!-- Bootstrap -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/bootstrap.min.js"></script>
<!-- Waypoints -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.waypoints.min.js"></script>
<!-- Stellar Parallax -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.stellar.min.js"></script>
<!-- Carousel -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/owl.carousel.min.js"></script>
<!-- Flexslider -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.flexslider-min.js"></script>
<!-- countTo -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.countTo.js"></script>
<!-- Magnific Popup -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/jquery.magnific-popup.min.js"></script>
<script src="{{asset('AdminLTE')}}/assets/profile/js/magnific-popup-options.js"></script>
<!-- Count Down -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/simplyCountdown.js"></script>
<!-- Main -->
<script src="{{asset('AdminLTE')}}/assets/profile/js/main.js"></script>

<script>
	var d = new Date(new Date().getTime() + 1000 * 120 * 120 * 2000);

	// default example
	simplyCountdown('.simply-countdown-one', {
		year: d.getFullYear(),
		month: d.getMonth() + 1,
		day: d.getDate()
	});

	//jQuery example
	$('#simply-countdown-losange').simplyCountdown({
		year: d.getFullYear(),
		month: d.getMonth() + 1,
		day: d.getDate(),
		enableUtc: false
	});
</script>
</body>

</html>