@extends('guru.layouts.master')
@section('title','Dashboard')
@section('judul','Dashboard')

@section('content')
<div class="container-fluid">
        <div class="card card-default">
            <div class="card-body">
    <div class="row justify-content-center">
        <div class="col-12">
                <section id="about" class="bg-light" style="padding-top:20px">
                    
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/akreditas.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Visi</h3>
                    <p style="padding: 0px 0px;" data-aos="fade-left">
                    Menjadi SMK unggulan yang mampu mencetak lulusan yang professional, mandiri, dan berakhlakul karimah.
                    </p>
                </div>
            </div>
            <div class="row" style="padding-bottom: 50px;">
                <div class="col-md-2 col-sm-12">
                    <img src="{{asset('images/bangunan.png')}}" class="img-rounded" width="90%" alt="" data-aos="fade-right">
                </div>
                <div class="col-md-10 col-sm-12">
                    <h3>Misi</h3>
                    <ul style="padding: 20px 0px;" data-aos="fade-left">
                <li>Menyiapkan tenaga kerja tingkat menengah untuk mengisi keperluan pembangunan.</li>
                <li>Mempersiapkan tenaga kerja yang berkualitas dan profesional, sehingga mampu berperan sebagai faktor keunggulan industri Indonesia.</li>
                <li>Membekali keahlian kepada tamatan yang dapat diandalkan sebagai bekal membuat dirinya menjadi produktif, meningkatkan taraf hidupnya dan mampu menjadi bekal keahlian.</li>
                <li>Memberikan bekal dasar kepada tamatan untuk mengembangkan dirinya secara berkelanjutan.</li>
                </ul>
                </div>
            </div>
    </section>
                </div>
                </div>
                </div>
                </div>


@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
        <script>
        AOS.init();
</script>
@stop