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
                <a class="nav-link" aria-current="page" href="pendaftar">Data Pendaftar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="orangtua">Data Orangtua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="sekolah">Data Sekolah</a>
            </li>
            </ul>
            
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Nama</th>
                            <th>KK</th>
                            <th>Nama Ayah</th>
                            <th>Nama Ibu</th>
                            <th>Pekerjaan Ayah</th>
                            <th>Pekerjaan Ibu</th>
                            <th>No HP Ortu</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($pendaftaran as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->nama }}</td>
                                <td> @if ($row->kk !== null)
                                        <img src="{{ asset('storage/kk/' . $row->kk) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td>{{ $row->nama_ayah}}</td>
                                <td>{{ $row->nama_ibu }}</td>
                                <td>{{ $row->pekerjaan_ayah }}</td>
                                <td>{{ $row->pekerjaan_ibu }}</td>
                                <td>{{ $row->no_hp_ortu }}</td>
                               
                                
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @stop