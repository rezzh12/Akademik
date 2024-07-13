<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrasi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center">Laporan Administrasi Siswa</h3>
    <h1 class="text-center">SMK PGRI 2 Cianjur</h1>
    <p class="text-center">Sawah Gede , Kec. Cianjur, Kab. Cianjur, Jawa Barat</p>
    <br />

    <div class="container-fluid">
    <table id="datatable" class="table table-striped table-white">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Tanggal </th>
                            <th>Nama </th>
                            <th>Jenis </th>
                            <th>Bulan </th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($administrasi as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->tanggal }}</td>
                                <td>{{ $row->siswa->nama_lengkap }}</td>
                                <td>{{ $row->administrasi->jenis }}</td>
                                <td>{{ $row->bulan }}</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->administrasi->jumlah }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <td>Jumlah</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>{{$jumlah}}</td>
                    </tr>         
</tfoot>
                    
                </table>

                
                </table>
                <table id="table_data" class="table table-borderless">
    <tr>
        <td> 
        <p >Kepala Sekolah <br>SMK PGRI 2 Cianjur</p>
        <p></p>
        <p></p>
        @foreach($kepala as $row)
        <p >{{$row->name}} <br>
        NUPTK.{{$row->id_status}}
    </p>
        @endforeach
        <td>
        <div class="col-4" style="padding-left:200px;"></div></td>
        </td>
        <td> 
        {{ $tanggal}} <br> Kepala Tata Usaha
        <p></p>
        <p></p>
        <p></p>
        @foreach($TU as $row)
        <p >{{$row->name}} <br>
        NUPTK.{{$row->id_status}}
    </p>
        @endforeach
        </td>
    </tr>
    
</table>

</body>

</html>