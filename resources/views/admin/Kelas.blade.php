@extends('admin.layouts.master')
@section('title','Data Kelas')
@section('judul','Data Kelas')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Kelas') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahKelasModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Kode Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Jurusan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($kelas as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->kode_kelas }}</td>
                                <td >{{$row->tingkatan_kelas}} {{ $row->nama_kelas }}</td>
                                <td >{{ $row->jurusan->singkatan }}</td>
                                <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-kelas" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahKelasModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama_kelas }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Tambah Tingkatan -->
<div class="modal fade" id="tambahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kelas.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_kelas">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="nama_kelas" required />
                        </div>
                      
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
                        <label for="jurusan_id">Jurusan</label>
                            <select name="jurusan_id" id="edit-jurusan_id" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                                <option value="{{$jr->id}}">{{$jr->nama_jurusan}}</option>
                            @endforeach
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


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahKelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Kelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.kelas.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nama_kelas">Nama Kelas</label>
                            <input type="text" class="form-control" name="nama_kelas" id="edit-nama_kelas" required />
                        </div>
                       
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
                        <label for="edit-jurusan">Jurusan</label>
                            <select name="jurusan_id" id="edit-jurusan" class="form-control">
                                <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $jr)
                            <option value="{{$jr->id}}">{{$jr->nama_jurusan}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="kode" id="edit-kode" />
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
            $(document).on('click', '#btn-edit-kelas', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataKelas') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-kode').val(res.kode_kelas);
                        $('#edit-nama_kelas').val(res.nama_kelas);
                        $('#edit-tingkatan_kelas').val(res.tingkatan_kelas);
                        $('#edit-jurusan').val(res.jurusan_id);
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
                text: "Apakah anda yakin akan menghapus data kelas dengan nama " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "kelas/delete/" + npm,
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