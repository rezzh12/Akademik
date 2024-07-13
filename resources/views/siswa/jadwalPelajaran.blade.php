@extends('siswa.layouts.master')
@section('title','Data Jadwal Pelajaran')
@section('judul','Data Jadwal Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Jadwal Pelajaran') }}</div>
            <div class="card-body">
         
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Semester</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jadwal as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{$row->mapel->nama_mapel}}</td>
                                <td >{{$row->guru->nama_lengkap}}</td>
                                <td >{{$row->kelas->nama_kelas}}</td>
                                <td >{{$row->hari}}</td>
                                <td >{{$row->jam}}</td>
                                <td >{{$row->kurikulum->semester}}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop
   