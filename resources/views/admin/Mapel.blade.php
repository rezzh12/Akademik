@extends('admin.layouts.master')
@section('title','Data Mata Pelajaran')
@section('judul','Data Mata Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Mata Pelajaran') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMapelModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Kode Mapel</th>
                            <th>Nama Mata Pelajaran </th>
                            <th>Kurikulum </th>
                            <th>Semester </th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($mapel as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->kode_mapel }}</td>
                                <td>{{ $row->nama_mapel }}</td>
                                <td>{{ $row->kurikulum->nama_kurikulum }}</td>
                                <td>{{ $row->kurikulum->semester }}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-mapel" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahMapelModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama_mapel }}' )"><i class="fa fa-times"></i></button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.mapel.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nama_mapel">Nama Mata Pelajaran</label>
                            <input type="text" class="form-control" name="nama_mapel" id="nama_mapel" required />
                        </div>
                        <div class="form-group">
                            <label for="kurikulum">Kurikulum</label>
                            <select class="form-control" name="kurikulum" id="kurikulum" required>
                            <option value="">Pilih Kurikulum</option>
                                @foreach($kurikulum as $kk)
                                <option value="{{$kk->id}}">{{$kk->nama_kurikulum}} {{$kk->semester}}</option>
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
     <div class="modal fade" id="ubahMapelModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Mapel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.mapel.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nama_mapel">Nama Mapel</label>
                            <input type="text" class="form-control" name="nama_mapel" id="edit-nama_mapel" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-kurikulum">Kurikulum</label>
                            <select class="form-control" name="kurikulum" id="edit-kurikulum" required>
                            <option value="">Pilih Kurikulum</option>
                                @foreach($kurikulum as $kk)
                                <option value="{{$kk->id}}">{{$kk->nama_kurikulum}} {{$kk->semster}}</option>
                                @endforeach
                            </select>
                        </div>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="id" id="edit-id" />
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
                    url: "{{ url('/admin/ajaxadmin/dataMapel') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-nama_mapel').val(res.nama_mapel);
                        $('#edit-kode').val(res.kode_mapel);
                        $('#edit-kurikulum').val(res.kurikulum_id);
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
                        url: "mapel/delete/" + npm,
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