<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
</head>

<body>
    <h3 class="text-center">Laporan Penilaian</h3>
    <h1 class="text-center">SMK PGRI 2 Cianjur</h1>
    <p class="text-center">Sawah Gede , Kec. Cianjur, Kab. Cianjur, Jawa Barat</p>
    <br />

    <div class="container-fluid">
    <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Nama Guru</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($penilaian as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->tanggal }}</td>
                            <td >{{ $row->nama_lengkap }}</td>
                            <td >{{ $row->judul }}</td>
                            <td >{{ $row->kategori }}</td>
                           
                        </tr>
                                @endforeach
                    </tbody>
                </table>
                
                <table id="table_data" class="table table-borderless">
    <tr>
        <td> 
        <p ></p>
        <p></p>
        <p></p>
       
        <p ><br>
    
    </p>
        
        <td>
        <div class="col-4" style="padding-left:250px;"></div></td>
        </td>
        <td> 
        <p >Kepala Sekolah <br>SMK PGRI 2 Cianjur</p>
        <p></p>
        <p></p>
        <p></p>
        @foreach($kepala as $row)
        <p >{{$row->name}} <br>
        NUPTK.{{$row->id_status}}
    </p>
        @endforeach
        </td>
    </tr>
    
</table>

</body>

</html>