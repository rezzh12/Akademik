<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email</title>
</head>
<body>
    <h1>SURAT KETERANGAN TANDA TERIMA</h1>
    <P>Kepala Sekolah SMK PGRI 2 Cianjur menerangkan</P>
    <p>NISN : {{$user->NISN}}</p>
    <p>Nama : {{$user->nama}}</p>
    <p>sesuai dengan hasil tes yang telah dilaksanakan anda dinyatakan</p>
    @if($user->status_pendaftaran == 1)
    <h2>Selamat anda di terima di Jurusan {{$user->jurusan->nama_jurusan}}</h2>
    <p>demikian surat keterangan Tanda Lulus ini diperbuat dengan sebenar-benarnya</p>
    @else
    <h2>Mohon Maaf anda tidak terima di jursanurusan {{$user->jurusan->nama_jurusan}}</h2>
    <p>demikian surat keterangan Tanda Lulus ini diperbuat dengan sebenar-benarnya</p>
    @endif
</body>
</html>