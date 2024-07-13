@extends('tamplate.master')
@section('judul', 'Beranda')
@section('content')
<aside id="fh5co-hero">
	<div class="flexslider">
		<ul class="slides">
			<li style="background-image: url({{asset('images/foto1.jpg')}}">
				<div class="overlay-gradient"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center slider-text">
							<div class="slider-text-inner">
                            <h1>Penerimaan Peserta Didik Baru</h1>
								<h2>Penerimaan Peserta Didik Tahun Pelajaran {{$angkatan}} Telah Dibuka</h2>
								<p><a class="btn btn-primary btn-lg" href="{{ route('login') }}">Daftar Sekarang</a></p>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li style="background-image: url({{asset('images/foto2.jpg')}}">
				<div class="overlay-gradient"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center slider-text">
							<div class="slider-text-inner">
								<h1>Penerimaan Peserta Didik Baru</h1>
								<h2>Penerimaan Peserta Didik Tahun Pelajaran {{$angkatan}} Telah Dibuka</h2>
								<p><a class="btn btn-primary btn-lg" href="{{ route('login') }}">Daftar Sekarang</a></p>
							</div>
						</div>
					</div>
				</div>
			</li>
			<li style="background-image: url({{asset('images/foto3.jpg')}}">
				<div class="overlay-gradient"></div>
				<div class="container">
					<div class="row">
						<div class="col-md-8 col-md-offset-2 text-center slider-text">
							<div class="slider-text-inner">
                            <h1>Penerimaan Peserta Didik Baru</h1>
								<h2>Penerimaan Peserta Didik Tahun Pelajaran {{$angkatan}} Telah Dibuka</h2>
								<p><a class="btn btn-primary btn-lg" href="{{ route('login') }}">Daftar Sekarang</a></p>
							</div>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>
</aside>

<div id="fh5co-about">
	<div class="container">
		<div class="col-md-6 animate-box">
			<span>Kepala Sekolah SMK PGRI 2 CIANJUR</span>
			<h2>Ade Setiawati S,Pd.,M.M </h2>
			<p>Assalaamu’alaikum Wr. Wb.</p>
			<p>Puji syukur kami panjatkan ke hadirat Allah SWT yang atas berkat rahmat dan hidayah-Nya kami bisa meluncurkan situs web SMK PGRI 2 CIANJUR ini di Internet. Situs web ini bertujuan untuk memperkenalkan SMK PGRI 2 CIANJUR sebagai lembaga pendidikan dengan memanfaatkan media teknologi internet.</p>
			<p>Dengan adanya situs web ini, kami berharap SMK PGRI 2 CIANJUR ini dapat lebih dikenal di kalangan yang lebih luas. Selain itu melalui situs web ini juga, kami berharap dapat memberi kemudahan bagi para siswa dan orang tuanya untuk mengakses informasi mengenai kegiatan belajar mengajar di SMK PGRI 2 CIANJUR ini dengan cepat, efisien dan online 24 jam. Akhir kata, kami berharap situs web ini dapat memberikan manfaat positif bagi siapa saja yang mengunjungi situs web kami ini.</p>
			<p>Wassalaamu’alaikum Wr. Wb.</p>
			<h3>Visi</h3>
                    <p data-aos="fade-left">
                    Menjadi SMK unggulan yang mampu mencetak lulusan yang professional, mandiri, dan berakhlakul karimah.
                    </p>
			<h3>Misi</h3>
                    <ul data-aos="fade-left">
                <li>Menyiapkan tenaga kerja tingkat menengah untuk mengisi keperluan pembangunan.</li>
                <li>Mempersiapkan tenaga kerja yang berkualitas dan profesional, sehingga mampu berperan sebagai faktor keunggulan industri Indonesia.</li>
                <li>Membekali keahlian kepada tamatan yang dapat diandalkan sebagai bekal membuat dirinya menjadi produktif, meningkatkan taraf hidupnya dan mampu menjadi bekal keahlian.</li>
                <li>Memberikan bekal dasar kepada tamatan untuk mengembangkan dirinya secara berkelanjutan.</li>
                </ul>
                
		</div>
		<div class="col-md-6">
			<img class="img-responsive" src="{{asset('images/kepala.jpg')}}" alt="Kepala Sekolah">
		</div>
	</div>
</div>

<div id="fh5co-counter" class="fh5co-counters" style="background-image: url({{asset('images/img_bg_4.jpg')}}" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">

			<div class="col-md-10 col-md-offset-1">
				<div class="row">
					
						<div class="col-md-3 col-sm-6 text-center animate-box">
							<span class="icon"><i class="fa fa-users"></i></span>
							<span class="fh5co-counter js-counter" data-from="0" data-to="{{$siswa->count()}}" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Jumlah Siswa</span>
						</div>
						<div class="col-md-3 col-sm-6 text-center animate-box">
							<span class="icon"><i class="fa fa-user-graduate"></i></span>
							<span class="fh5co-counter js-counter" data-from="0" data-to="{{$guru->count()}}" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Jumlah Guru</span>
						</div>
						<div class="col-md-3 col-sm-6 text-center animate-box">
							<span class="icon"><i class="fa fa-network-wired"></i></span>
							<span class="fh5co-counter js-counter" data-from="0" data-to="{{$jurusan->count()}}" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Jumlah Jurusan</span>
						</div>
						<div class="col-md-3 col-sm-6 text-center animate-box">
							<span class="icon"><i class="fa fa-gamepad"></i></span>
							<span class="fh5co-counter js-counter" data-from="0" data-to="{{$ekskul->count()}}" data-speed="5000" data-refresh-interval="50"></span>
							<span class="fh5co-counter-label">Jumlah Ekskul </span>
						</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div id="fh5co-blog jurusan">
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
            <h2>Jurusan</h2>
				<p>Disini User Dapat Melihat Tentang Jurusan Yang Ada di SMK PGRI 2 Cianjur.</p>
			</div>
		</div>
		<div class="row">
		@foreach ($jurusan1 as $j)
				<div class="col-lg-4 col-md-4">
					<div class="fh5co-blog animate-box">
						<a href="" class="blog-img-holder" style="background-image: url({{asset('storage/jurusan/'.$j->foto)}}"></a>
						<div class="blog-text">
                        <span class="posted_on">{{$j->nama_jurusan}}</span>
							<p>{{$j->deskripsi}}</p>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>
</div>

<div id="fh5co-blog">
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
				<h2>Ekskul</h2>
				<p>Disini User Dapat Melihat Tentang Ekskul Yang Ada di SMK PGRI 2 Cianjur.</p>
			</div>
		</div>
		<div class="row">
		@foreach ($ekskul1 as $j)
				<div class="col-lg-4 col-md-4">
					<div class="fh5co-blog animate-box">
						<a href="" class="blog-img-holder" style="background-image: url({{asset('storage/ekskul/'.$j->foto)}}"></a>
						<div class="blog-text">
							<span class="posted_on">{{$j->nama}}</span>
							<p>{{$j->deskripsi}}</p>
						</div>
					</div>
				</div>
			@endforeach
			</div>
		</div>
	</div>

<div id="fh5co-course-categories">
	<div class="container">
		<div class="row animate-box">
			<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
				<h2>Pengalaman dan Fasilitas</h2>
				<p>Dibawah Sini adalah beberapa pengalaman dan fasilitas yang akan anda dapatkan</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-shop"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Laboratorium</a></h3>
						<p>Laboratorium SMK PGRI 2 CIANJUR Didukung oleh tim peneliti dan teknisi berpengalaman yang berdedikasi untuk membantu Anda mencapai hasil terbaik dan Dilengkapi dengan alat-alat laboratorium terbaru dan termodern untuk memastikan penelitian Anda dilakukan dengan presisi dan akurasi tinggi.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-heart4"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Kebersihan &amp; Kesehatan</a></h3>
						<p>Kebersihan dan kesehatan SMK PGRI 2 CIANJUR Menyediakan lingkungan yang bersih dengan pembersihan rutin dan menyeluruh di semua area sekolah dan Menyediakan fasilitas sanitasi yang memadai, seperti tempat cuci tangan, hand sanitizer, dan toilet yang bersih serta Memastikan ventilasi yang baik dan ruang terbuka yang memadai untuk mendukung aktivitas fisik dan rekreasi</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-banknote"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Keuangan</a></h3>
						<p>SMK PGRI 2 CIANJUR Menyediakan berbagai pilihan metode pembayaran, termasuk transfer bank, kartu kredit/debit, dan dompet digital serta Menyediakan laporan transaksi yang lengkap dan mudah dipahami untuk memantau pembayaran Anda.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-lab2"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Komunitas</a></h3>
						<p>SMK PGRI 2 CIANJUR Mengajak semua anggota komunitas untuk terlibat aktif dalam berbagai kegiatan yang mendukung perkembangan pribadi dan sosial dan Menyediakan beragam kegiatan ekstrakurikuler dan klub yang memenuhi minat dan bakat setiap siswa serta Mendorong pengembangan karakter melalui program-program yang mempromosikan nilai-nilai positif seperti kepemimpinan, kerjasama, dan tanggung jawab</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-photo"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Kesenian </a></h3>
						<p>SMK PGRI 2 CIANJUR mempunyai program yang dirancang dengan baik mencakup berbagai disiplin seni seperti seni rupa, musik, tari, dan teater serta Studio seni, ruang musik, dan panggung teater yang dilengkapi dengan peralatan canggih untuk mendukung pembelajaran.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-home-outline"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Organisasi</a></h3>
						<p>Organisasi SMK PGRI 2 CIANJUR dapat mengembangkan keterampilan kepemimpinan melalui berbagai peran dan tanggung jawab di organisasi Membangun serta jaringan pertemanan dan profesional yang akan berguna di masa depan.

</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-bubble3"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Ekskul</a></h3>
						<p>SMK PGRI 2 CIANJUR Menawarkan berbagai pilihan kegiatan yang sesuai dengan minat dan bakat siswa, mulai dari olahraga hingga seni dan sains sehingga Membantu siswa mengembangkan keterampilan sosial, kepemimpinan, dan kerja sama tim melalui kegiatan yang menyenangkan dan menantang.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3 col-sm-6 text-center animate-box">
				<div class="services">
					<span class="icon">
						<i class="icon-world"></i>
					</span>
					<div class="desc">
						<h3><a href="#">Wifi Gratis</a></h3>
						<p>SMK PGRI 2 CIANJUR mempunyai konektivitas internet yang cepat dan stabil di seluruh area sekolah, memungkinkan akses mudah ke sumber daya online sehingga dapat Memfasilitasi pembelajaran berbasis teknologi, akses ke materi online, dan penggunaan alat pembelajaran digital.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<section id="location">
        <div class="container-fluid">
            <h2 class="text-center" style="padding:50px;" data-aos="fade-up">Lokasi</h2>
            <div class="row">
			<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3961.542217648203!2d107.12437167483456!3d-6.825393093172449!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e68525fc68bfb9d%3A0x1a341c6e53c9460f!2sSMK%20PGRI%202%20Cianjur!5e0!3m2!1sen!2sid!4v1710744931670!5m2!1sen!2sid" width="1500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" width="100%"></iframe>
            </div>
        </div>
    </section>
@stop
