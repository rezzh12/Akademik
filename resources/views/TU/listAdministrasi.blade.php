@extends('TU.layouts.master')
@section('title','Data List Administrasi')
@section('judul','Data List Administrasi')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data List Administrasi') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMapelModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Kode</th>
                            <th>Tingkatan Kelas </th>
                            <th>Jenis </th>
                            <th>Jumlah bayar </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($administrasi as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode }}</td>
                                <td>{{ $row->tingkatan_kelas }}</td>
                                <td>{{ $row->jenis }}</td>
                                <td>{{ $row->jumlah }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-mapel" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahMapelModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->kode }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Tambah Mapel -->
<div class="modal fade" id="tambahMapelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data List Administrasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('TU.administrasi.submit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                        <label for="tingkatan_kelas"> Tingakatan Kelas</label>
                            <select name="tingkatan_kelas" id="tingkatan_kelas" class="form-control">
                                <option value="">Pilih Tingakatan Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="jenis">Jenis</label>
                            <input type="text" class="form-control" name="jenis" id="jenis" required />
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="jumlah" required />
                        </div>
                        </div>
                        
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahMapelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data List Administrasi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('TU.administrasi.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <label for="edit-tingkatan_kelas"> Tingakatan Kelas</label>
                            <select name="tingkatan_kelas" id="edit-tingkatan_kelas" class="form-control">
                                <option value="">Pilih Tingakatan Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-jenis">Jenis</label>
                            <input type="text" class="form-control" name="jenis" id="edit-jenis" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-jumlah">Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" id="edit-jumlah" required />
                        </div>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="akademik" id="edit-akademik" />
                <input type="hidden" name="kode" id="edit-kode" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
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