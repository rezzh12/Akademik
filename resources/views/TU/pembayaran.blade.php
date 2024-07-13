@extends('TU.layouts.master')
@section('title','Data Pembayaran')
@section('judul','Data Pembayaran')

@section('content')
    <div class="container-fluid">
    <div>
    <table id="datatable" class="table table-striped table-white table-responsive-lg">
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
            <div class="card-header">{{ __('Input Pembayaran') }}</div>
            <div class="card-body">
            <form method="post" action="{{ route('TU.bayar.submit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                        <label for="jenis"> Jenis Pembayaran</label>
                            <select name="jenis" id="jenis" class="form-control">
                                <option value="">Pilih Jenis Pembayaran</option>
                                @foreach ($administrasi1 as $row)
                            <option value="{{ $row->id }}">{{ $row->jenis }}</option>
                         @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="bulan"> Bulan</label>
                            <select name="bulan" id="bulan" class="form-control">
                                <option value="">Pilih Bulan</option>
                            <option value="Januari">Januari</option>
                            <option value="Ferbruari">Ferbruari</option>
                            <option value="Maret">Maret</option>
                            <option value="April">April</option>
                            <option value="Mei">Mei</option>
                            <option value="Juni">Juni</option>
                            <option value="Juli">Juli</option>
                            <option value="Agustus">Agustus</option>
                            <option value="September">September</option>
                            <option value="Oktober">Oktober</option>
                            <option value="November">November</option>
                            <option value="Desember">Desember</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Bukti Pembayaran</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" required />
                        </div>
                     
                        </div>
                        
                <div class="modal-footer">
                @foreach ($siswa as $row)
                <input type="hidden" name="NISN" id="edit-NISN" value="{{$row->NISN}}"/>
                @endforeach
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
            </div>
        </div>
    </div>
    <div class="card card-default">
            <div class="card-header">{{ __('Riwayat Data Pembayaran') }}</div>
            <div class="card-body">
                <table id="datatable" class="table table-striped table-white table-responsive-lg">
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