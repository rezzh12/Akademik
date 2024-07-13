@extends('admin.layouts.master')
@section('title','Data Jurusan')
@section('judul','Data Jurusan')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Jurusan') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Kode Jurusan</th>
                            <th>Program Keahlian</th>
                            <th>Nama Jurusan</th>
                            <th>Singkatan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jurusan as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->kode_jurusan }}</td>
                                <td >{{ $row->program_keahlian }}</td>
                                <td >{{ $row->nama_jurusan }}</td>
                                <td >{{ $row->singkatan }}</td>
                                <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jurusan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJurusanModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jurusan.submit') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="program_keahlian">Program Keahlian</label>
                            <input type="text" class="form-control" name="program_keahlian" id="program_keahlian" required />
                        </div>
                        <div class="form-group">
                            <label for="nama_jurusan">Nama Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" id="nama_jurusan" required />
                        </div>
                        <div class="form-group">
                            <label for="singkatan">Singkatan</label>
                            <input type="text" class="form-control" name="singkatan" id="singkatan" required />
                        </div>
                        <div class="form-group">
                        <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        
                        </div>
                        <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="deskripsi" required />
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


     <!-- Ubah Jurusan -->
     <div class="modal fade" id="ubahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jurusan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jurusan.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-program_keahlian">Program Keahlian</label>
                            <input type="text" class="form-control" name="program_keahlian" id="edit-program_keahlian" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-nama_jurusan">Nama Jurusan</label>
                            <input type="text" class="form-control" name="nama_jurusan" id="edit-nama_jurusan" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-singkatan">Singkatan</label>
                            <input type="text" class="form-control" name="singkatan" id="edit-singkatan" required />
                        </div>
                        <div class="form-group">
                        <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        
                        </div>
                        <div class="form-group">
                        <label for="edit-deskripsi">Deskripsi</label>
                            <input type="text" class="form-control" name="deskripsi" id="edit-deskripsi" required />
                        </div>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="old_foto" id="edit-old_foto" />
                <input type="hidden" name="kode_jurusan" id="edit-kode_jurusan" />
                <input type="hidden" name="akademik" id="edit-akademik" />
                <input type="hidden" name="id" id="edit-id" />
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
            $(document).on('click', '#btn-edit-jurusan', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataJurusan') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode_jurusan').val(res.kode_jurusan);
                        $('#edit-program_keahlian').val(res.program_keahlian);
                        $('#edit-nama_jurusan').val(res.nama_jurusan);
                        $('#edit-singkatan').val(res.singkatan);
                        $('#edit-deskripsi').val(res.deskripsi);
                        $('#edit-old_foto').val(res.foto);
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
                        url: "jurusan/delete/" + npm,
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