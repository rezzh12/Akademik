@extends('admin.layouts.master')
@section('title','Data Kurikulum')
@section('judul','Data Kurikulum')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Kurikulum') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKurikulumModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Nama Kurikulum</th>
                            <th>Semester</th>
                            <th>Status </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($kurikulum as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->nama_kurikulum }}</td>
                                <td >{{ $row->semester }}</td>
                                <td > @if($row->status == 1)
                                        <span >AKTIF</span>
                                    @else
                                        <span >TIDAK AKTIF</span>
                                    @endif</td>
                                <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-kurikulum" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahKurikulumModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama_kurikulum }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Tambah Kurikulum -->
<div class="modal fade" id="tambahKurikulumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kurikulum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kurikulum.submit') }}" enctype="multipart/form-data">
                        @csrf
                      
                        <div class="form-group">
                            <label for="nama_kurikulum">Nama Kurikulum</label>
                            <input type="text" class="form-control" name="nama_kurikulum" id="nama_kurikulum" required />
                        </div>
                        <div class="form-group">
                        <label for="semester">Semester</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="status">Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
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


     <!-- Ubah Kurikulum -->
     <div class="modal fade" id="ubahKurikulumModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kurikulum</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kurikulum.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                       
                        <div class="form-group">
                            <label for="edit-nama_kurikulum">Nama Kurikulum</label>
                            <input type="text" class="form-control" name="nama_kurikulum" id="edit-nama_kurikulum" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-semester">Semester</label>
                            <select name="semester" id="edit-semester" class="form-control">
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil">Ganjil</option>
                                <option value="Genap">Genap</option>
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-status">Status</label>
                            <select name="status" id="edit-status" class="form-control">
                                <option value="">Pilih Status</option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="akademik" id="edit-akademik" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    @stop

    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-kurikulum', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataKurikulum') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_kurikulum').val(res.tahun_kurikulum);
                        $('#edit-nama_kurikulum').val(res.nama_kurikulum);
                        $('#edit-semester').val(res.semester);
                        $('#edit-status').val(res.status);
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
                text: "Apakah anda yakin akan menghapus data buku dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "kurikulum/delete/" + npm,
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