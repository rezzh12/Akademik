@extends('admin.layouts.master')
@section('title','Data Walikelas')
@section('judul','Data Walikelas')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Walikelas') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahWalikelasModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NUPTK</th>
                            <th>Nama Walikelas</th>
                            <th>Kelas</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; 
                    @endphp
                        @foreach ($walikelas as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->guru->NUPTK }}</td>
                                <td >{{ $row->guru->nama_lengkap }}</td>
                                <td >{{ $row->kelas->nama_kelas }}</td>
                                
                                <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-walikelas" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahWalikelasModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->guru->nama_lengkap }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<!-- Tambah Guru -->
<div class="modal fade" id="tambahWalikelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Walikelas</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.walikelas.submit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                        <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="guru">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
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

    
     <!-- Ubah Guru -->
     <div class="modal fade" id="ubahWalikelasModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.walikelas.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <label for="edit-kelas">Kelas</label>
                            <select name="kelas" id="edit-kelas" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="edit-guru">Guru</label>
                            <select name="guru" id="edit-guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        

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
            $(document).on('click', '#btn-edit-walikelas', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataWalikelas') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-akademik').val(res.tahun_akademik_id);
                        $('#edit-kelas').val(res.kelas_id);
                        $('#edit-guru').val(res.NUPTK);
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
                        url: "walikelas/delete/" + npm,
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
