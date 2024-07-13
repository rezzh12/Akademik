@extends('TU.layouts.master')
@section('title', 'Data Pendaftar')
@section('judul', 'Data Pendaftar')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Pendaftaran Mahasiswa Baru') }}</div>
            <div class="card-body"> 
            <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="pendaftar">Data Pendaftar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="orangtua">Data Orangtua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="sekolah">Data Sekolah</a>
            </li>
            </ul>
            
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Jurusan</th>
                            <th>Asal Sekolah</th>
                            <th>Alamat Sekolah</th>
                            <th>Nilai Raport</th>
                            <th>Ijazah</th>
                            <th>Prestasi</th>
                            <th>pas_foto</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($pendaftaran as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->jurusan->nama_jurusan}}</td>
                                <td>{{ $row->asal_sekolah }}</td>
                                <td>{{ $row->alamat_sekolah }}</td>
                                <td>@if ($row->nilai_raport !== null)
                                        <img src="{{ asset('storage/nilai_raport/' . $row->nilai_raport) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td>@if ($row->ijazah !== null)
                                        <img src="{{ asset('storage/ijazah/' . $row->ijazah) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td> @if ($row->prestasi !== null)
                                        <img src="{{ asset('storage/prestasi/' . $row->prestasi) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td> @if ($row->pas_foto !== null)
                                        <img src="{{ asset('storage/pas_foto/' . $row->pas_foto) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop