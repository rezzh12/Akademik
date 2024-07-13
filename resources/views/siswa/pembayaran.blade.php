@extends('siswa.layouts.master')
@section('title','Data Pembayaran')
@section('judul','Data Pembayaran')

@section('content')
    <div class="container-fluid">
    <div>
    <table id="datatable" class="table ">
                    @foreach ($siswa as $row)
                        <tbody>
                            <tr>
                            <td >Nama</td>
                            <td >:</td>
                            <td >{{$row->nama_lengkap}}</td>
                            <td><div style="padding-left:200px;"></div></td>
                                <td >NISN</td>
                                <td >:</td>
                                <td >{{$row->NISN}}</td>
                            </tr>
                            <tr>
                                <td >Jenis Kelamin</td>
                                <td >:</td>
                                <td >{{$row->gender}}</td>
                                <td></td>
                                <td >Tempat,Tanggal Lahir</td>
                                <td >:</td>
                                <td >{{$row->tempat_lahir}},{{$row->tanggal_lahir}}</td>
                            </tr>
                            <tr>
                                <td >Agama</td>
                                <td >:</td>
                                <td >{{$row->agama}}</td>
                                <td></td>
                                <td >Kelas</td>
                                <td >:</td>
                                <td >{{$row->kelas->tingkatan_kelas}} / {{$row->kelas->nama_kelas}}</td>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                    <hr />

        <div class="card card-default">
            <div class="card-header">{{ __('List Administrasi') }}</div>
            <div class="card-body">
            <table id="datatable" class="table table-striped table-white">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Kode</th>
                            <th>Tingkatan Kelas </th>
                            <th>Jenis </th>
                            <th>Perbulan </th>
                            <th>Jumlah </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($administrasi1 as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode }}</td>
                                <td>{{ $row->tingkatan_kelas }}</td>
                                @if($row->jenis == "UDB")
                                <td>{{ $row->jenis }} *12</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>{{ $row->jumlah *12 }}</td>
                               @else
                               <td>{{ $row->jenis }}</td>
                               <td></td>
                               <td>{{ $row->jumlah }}</td>
                               @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-default">
            <div class="card-header">{{ __('Riwayat Data Pembayaran') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Tanggal </th>
                            <th>Jenis </th>
                            <th>Bulan </th>
                            <th>Bukti</th>
                            <th>Keterangan</th>
                            <th>Jumlah</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($pembayaran as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->tanggal }}</td>
                                <td>{{ $row->administrasi->jenis }}</td>
                                <td>{{ $row->bulan }}</td>
                                <td>@if ($row->foto !== null)
                                        <img src="{{ asset('storage/bukti/' . $row->foto) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                                <td>{{ $row->keterangan }}</td>
                                <td>{{ $row->administrasi->jumlah }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                    <td>Harus Dibayar</td>
                    <td></td>
                    <td></td>
                    <td>Telah Dibayar</td>
                    <td></td>
                    <td></td>
                    <td>Sisa</td>
                    </tr>
                    <tr>
                    <td>{{$total1}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$dibayar}}</td>
                    <td></td>
                    <td></td>
                    <td>{{$total}}</td>
                    </tr>
                  
  </tfoot>
                </table>
            </div>
        </div>
    </div>

    @stop

    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-mapel', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/TU/ajaxadmin/dataAdministrasi') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-tingkatan_kelas').val(res.tingkatan_kelas);
                        $('#edit-kode').val(res.kode);
                        $('#edit-jenis').val(res.jenis);
                        $('#edit-jumlah').val(res.jumlah);
                        $('#edit-akademik').val(res.tahun_akademik_id);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data mata pelajaran dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "administrasi/delete/" + npm,
                        data: {
                            _token: CSRF_TOKEN
                        },
                        dataType: 'JSON',
                        success: function(results) {
                            if (results.success === true) {
                                swal.fire("Done!", results.message, "success");
                                // refresh page after 2 seconds
                                setTimeout(function() {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire("Error!", results.message, "error");
                            }
                        }
                    });

                } else {
                    e.dismiss;
                }

            }, function(dismiss) {
                return false;
            })
        }

        </script>
    @stop