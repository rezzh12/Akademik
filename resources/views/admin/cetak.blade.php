<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Raport</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
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
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>A.Nilai Akademik</b></p>
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

    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>B.Catatan Akademik</b></p>
    <table id="table_data" class="table table-bordered">
        <tr>
            <td>
                <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">
                Ananda sudah mempunyai kompetensi muatan nasional dan muatan peminatan kejuruan yang cukup baik.
Semoga prestasi ananda lebih baik dari sebelumnya sehingga dapat membanggakan keluarga, jangan merasa 
puas dengan apa yang sudah raih, dan gapailah cita-citamu disertai dengan doa dan usaha.
                </p>
            </td>
        </tr>
    </table>
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>C.Ekstrakkulikuler</b></p>
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
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>D.Ketidakhadiran</b></p>
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
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>E.Deskripsi Pengembangan Karakter</b></p>
    <table id="table_data" class="table table-bordered">
       <thead style="font-size:10px; font-family: Arial, Helvetica, sans-serif;" class="text-center">
        <th>Karakter Yang Dibangun</th>
        <th>Deskripsi</th>
       </thead>
       <tbody style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">
        <tr>
            <td>Integritas</td>
            <td>Ananda bersikap @if($poin == null)sangat baik 
            @elseif($poin <= 99)sangat baik 
            @elseif($poin >= 100 && $poin <= 199) baik 
            @elseif($poin >= 200) Kurang 
            @endif
            dalam melaksanakan tanggung jawab dengan menyelesaikan 
                tugas yang diberikan
            </td>
        </tr>
        <tr>
            <td>Religius</td>
            <td>Ananda bersikap  @if($poin == null)sangat baik 
            @elseif($poin <= 99)sangat baik 
            @elseif($poin >= 100 && $poin <= 199) baik 
            @elseif($poin >= 200) Kurang 
            @endif dalam mengikuti kegiatan acara keagamaan di sekolah

            </td>
        </tr>
        <tr>
            <td>Nasionalis</td>
            <td>Ananda bersikap  @if($poin == null)sangat baik 
            @elseif($poin <= 99)sangat baik 
            @elseif($poin >= 100 && $poin <= 199) baik 
            @elseif($poin >= 200) Kurang 
            @endif dalam rasa nasionalisme dengan mengikuti kegiatan upacara 
            dan kegiatan lainnya

            </td>
        </tr>
        <tr>
            <td>Mandiri</td>
            <td>Ananda bersikap  @if($poin == null)sangat baik 
            @elseif($poin <= 99)sangat baik 
            @elseif($poin >= 100 && $poin <= 199) baik 
            @elseif($poin >= 200) Kurang 
            @endif dan mandiri dengan menyelesaikan tugas/amanah yang diberikan oleh 
            guru

            </td>
        </tr>
        <tr>
            <td>Gotong Royong</td>
            <td>Ananda bersikap  @if($poin == null)sangat baik 
            @elseif($poin <= 99)sangat baik 
            @elseif($poin >= 100 && $poin <= 199) baik 
            @elseif($poin >= 200) Kurang 
            @endif dalam melaksanakan kegiatan gotong royong dengan 
            membersihkan kelas dan kegiatan bersama lainnya
            </td>
        </tr>
       </tbody>
    </table>
    <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;"><b>F.Catatan Perkembangan Karakter</b></p>
    <table id="table_data" class="table table-bordered">
        <tr>
            <td>
                <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">
                Ananda menunjukkan perkembangan karakter yang cukup baik pada pembelajaran semester ini. Semoga menjadi 
                pribadi yang lebih baik dan menjadi manusia yang berguna bagi keluarga, masyarakat, agama dan negara
                </p>
            </td>
        </tr>
    </table>
    <table id="table_data" class="table table-borderless">
    <tr>
        <td> 
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">.</p>
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Orang Tua/Wali</p>
        <p></p>
        <p></p>
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif; text-decoration: underline;">_____________</p></td>
        <td>
        <div class="col-4" style="padding-left:200px;"></div></td>
        </td>
        <td> 
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">tanggal @foreach($tanggal as $row)
        {{ $row->tanggal}} <br> Walikelas
    @endforeach</p>
        <p></p>
        <p></p>
        @foreach($walikelas as $row)
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif; text-decoration: underline;">{{$row->nama_lengkap}} <br>
        NUPTK.{{$row->NUPTK}}
    </p>
        @endforeach
        </td>
    </tr>
    <tr>
        <td> <div class="col-4" style="padding-left:200px;"></div></td>
        <td> 
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif;">Mengetahui, <br> Kepala Sekolah</p>
        <p></p>
        <p></p>
        @foreach($kepala as $row)
        <p style="font-size:10px; font-family: Arial, Helvetica, sans-serif; text-decoration: underline;">{{$row->nama_lengkap}} <br>
        NUPTK.{{$row->NUPTK}} 
    </p>
        @endforeach
        </td>
        <td> <div class="col-4" style="padding-left:200px;"></div></td>
    </tr>
</table>



</body>

</html>