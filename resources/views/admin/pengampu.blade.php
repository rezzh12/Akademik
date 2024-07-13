@extends('admin.layouts.master')
@section('title','Data Pengampu')
@section('judul','Data Pengampu')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Data Pengampu') }}</div>
            <div class="card-body">
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Guru</th>
                            <th>Mata Pelajaran</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($pengampu as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->guru->nama_lengkap }}</td>
                            <td >{{ $row->mapel->nama_mapel }}</td>
                            <td >{{ $row->kelas->nama_kelas }}</td>
                           
                            <td >
                                <a class="btn btn-primary" href="penilaian/{{ $row->id }}"><i class="fa fa-eye"></i>penilaian</a>
                                <a class="btn btn-success"href="hasil/{{ $row->id }}"><i class="fa fa-book"></i>hasil</a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    @stop
   