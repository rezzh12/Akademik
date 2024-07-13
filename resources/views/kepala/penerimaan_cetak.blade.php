<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penerimaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center">Laporan Penerimaan Siswa</h3>
    <h1 class="text-center">SMK PGRI 2 Cianjur</h1>
    <p class="text-center">Sawah Gede , Kec. Cianjur, Kab. Cianjur, Jawa Barat</p>
    <br />

    <div class="container-fluid">
    <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr >
                        <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Jenis Kelamin</th>
                            <th>Agama</th>
                            <th>NO HP</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($penerimaan as $row)
                            <tr>
                            <td>{{ $no++ }}</td>
                                <td>{{ $row->NISN}}</td>
                                <td>{{ $row->nama}}</td>
                                <td>{{ $row->jenis_kelamin }}</td>
                                <td>{{ $row->agama }}</td>
                                <td>{{ $row->no_hp }}</td>  
                            </tr>
                        @endforeach
                    </tbody>
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