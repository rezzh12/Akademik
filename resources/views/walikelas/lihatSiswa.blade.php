@extends('walikelas.layouts.master')

@section('title', 'Data Siswa')
@section('judul', 'Data Siswa')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Siswa') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Kelas</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($siswa as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->NISN }}</td>
                                <td>{{ $row->nama_lengkap}}</td>
                                <td>{{ $row->kelas->nama_kelas}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="btn  btn-success" href="administrasi/{{$row->NISN}}/{{$row->kelas->tingkatan_kelas}}"><i class="fa fa-check"> Lihat</i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @stop
