@extends('walikelas.layouts.master')
@section('title','Data Laporan Nilai')
@section('judul','Data Laporan Nilai')

@section('content')
        <div class="card card-default">
            <div class="card-header">{{ __('Laporan Nilai') }}</div>
            <div class="card-body">
           
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($laporan as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->NISN }}</td>
                            <td >{{ $row->nama_lengkap }}</td>
                            <td >{{ $row->kelas->nama_kelas }}</td>
                          
                            <td >
                            <a class="btn btn-primary" href="laporan/{{ $row->NISN }}"><i class="fa fa-eye"></i>Laporan</a>
                                </td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    @stop