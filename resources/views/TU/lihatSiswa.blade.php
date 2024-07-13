@extends('TU.layouts.master')

@section('title', 'Data Siswa')
@section('judul', 'Data Siswa')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Siswa') }}</div>
            <div class="card-body">
            <table id="table-data" class="table table-striped table-white table-responsive-lg">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Laporan</button>
                    <hr />
                    <thead>
                        <tr >
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
                                    <a class="btn  btn-success" href="administrasi_siswa/{{$row->NISN}}/{{$row->kelas->tingkatan_kelas}}"><i class="fa fa-check"> Lihat</i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
 
<!-- Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('TU.administrasi.laporan') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="dari_tanggal">Dari Tanggal</label>
                            <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" required />
                        </div>
                        
                        </div>
                        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @stop
