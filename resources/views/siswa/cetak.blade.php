@extends('siswa.layouts.master')
@section('title','Data Nilai')
@section('judul','Data Nilai')

@section('content')
    <div class="container-fluid">
    <div>
                    <table>
                    @foreach ($riwayat as $row)
                        <tbody>
                            <tr>
                            <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Nama</td>
                            <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                            <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->nama_lengkap}}</td>
                            <td><div style="padding-left:200px;"></div></td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">NISN</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->NISN}}</td>
                            </tr>
                            <tr>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Prog.Keahlian</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->program_keahlian}}</td>
                                <td></td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Kompetensi Keahlian</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->nama_jurusan}}</td>
                            </tr>
                            <tr>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Tahun Pelajaran</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->tahun_akademik}}</td>
                                <td></td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Kelas/semester</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">:</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{$row->tingkatan_kelas}} / {{$row->semester}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                    <hr />

                    <div>
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">A.Nilai Akademik</p>
    <table id="table_data" class="table table-bordered">
        <thead>
            <tr class="text-center">
            <th style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">NO</th>
                            <th style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Nama Mata pelajaran</th>
                            <th style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Nilai</th>
                            <th style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Ketercapaian</th>
                            <th style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Deskripsi</th>
            </tr>
        </thead>

        <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                            <tr>
                                <td class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $no++ }}</td>
                                <td class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row->nama_mapel }}</td>
                                <td class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row->nilai }}</td>
                                <td class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row->ketercapaian }}</td>
                                <td class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row->deskripsi }}</td>
                                
                            </tr>
                        @endforeach
                    </tbody>

    </table>

    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">B.Ekstrakkulikuler</p>
    <table id="table_data" class="table table-bordered">
    <thead><tr> 
        <th class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">No</th>
        <th class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Kegiatan Ekstrakulikuler</th>
        <th class="text-center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Keterangan</th>
    </tr></thead>
    <tbody>
        @php $no=1; @endphp
                        @foreach ($ekskul as $row1)
                            <tr>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $no++ }}</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row1->nama }}</td>
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row1->deskripsi }}</td>
                                
                            </tr>
                        @endforeach 
    </tbody>
       

    </table>
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">C.Ketidakhadiran</p>
    <table id="table_data" class="table table-bordered">
  
    <tbody>
        <tr>
       <td rowspan="3" align="center" style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Ketidakhadiran</td>
       <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">1.Sakit</td>
       @foreach ($absen as $row2)
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row2->Sakit }} hari</td>
                        @endforeach 
                        </tr>
        <tr>
       <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">2.Izin</td>
       @foreach ($absen as $row2)
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row2->Izin }} hari</td>
                        @endforeach 
        <tr>
       <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">3.Tanpa Keterangan</td>
       @foreach ($absen as $row2)
                                <td style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">{{ $row2->Alfa }} hari</td>
                        @endforeach 
                        </tr>
    </tbody>
    </table>
    </div>

@stop