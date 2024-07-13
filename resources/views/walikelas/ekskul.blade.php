@extends('walikelas.layouts.master')
@section('title', 'Data Ekskul')
@section('judul', 'Data Ekskul')
@section('content')
    <div class="container-fluid">
   
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Ekskul') }}</div>
            <div class="card-body">
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Nama Guru</th>
                            <th>Nama Ekskul</th>
                            <th>Lihat Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($ekskul as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->guru->nama_lengkap }}</td>
                            <td >{{ $row->nama}}</td>
                          
                            <td >
                                <a href="riwayat_ekskul/{{ $row->id }}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @stop
   
