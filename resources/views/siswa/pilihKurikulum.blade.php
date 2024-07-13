@extends('siswa.layouts.master')
@section('title','Pilih Kurikulum')
@section('judul','Pilih Kurikulum')

@section('content')
<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
           @foreach($kurikulum as $row)
           <div class="col-lg-6 col-6">
            <!-- small box -->
            
            <a href="nilai/cetak/{{$row->kurikulum_id}}">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$row->kurikulum->nama_kurikulum}}</h3>
                

                <h5>{{$row->kurikulum->semester}}</h5>
              </div>
              <div class="icon">
                <i class="fa fa-id-badge"></i>
              </div>
             
            </div>
          </div>
          </a>
          @endforeach
          <!-- ./col -->
        </div>

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
         
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
</div>
@endsection