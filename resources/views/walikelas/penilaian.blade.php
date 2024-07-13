@extends('walikelas.layouts.master')
@section('title','Data Penilaian')
@section('judul','Data Penilaian')

@section('content')
    <div class="container-fluid">
    <div>
                    <table id="datatable" class="table table-white">
                    @foreach ($pengampu as $row)
                        <tbody>
                            <tr>
                                <td>Nama Guru</td>
                                <td>:{{ $row->guru->nama_lengkap }} </td>
                            </tr>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td>:{{ $row->mapel->nama_mapel }}</td>
                            </tr>
                            <tr>
                                <td>Kelas</td>
                                <td>:{{ $row->kelas->nama_kelas }}</>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                    <hr />

                    <div>
        <div class="card card-default">
            <div class="card-header">{{ __('Data Penilaian') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($penilaian as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->tanggal }}</td>
                            <td >{{ $row->judul }}</td>
                            <td >{{ $row->kategori }}</td>
                           
                            <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jurusan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJurusanModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->judul }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                <a href="riwayat/{{ $row->id }}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    
<!-- Tambah Jurusan -->
<div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('walikelas.penilaian.submit') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required />
                        </div>
                        <div class="form-group">
                        <label for="kategori"> Kategori</label>
                            <select name="kategori" id="kategori" class="form-control">
                                <option value="">Pilih Kategori</option>
                            <option value="Absen">Absen</option>
                            <option value="Tugas">Tugas</option>
                            <option value="Praktikum">Praktikum</option>
                            <option value="UTS">UTS</option>
                            <option value="UAS">UAS</option>
                            </select>
                        </div>
                        </div>
                        
                <div class="modal-footer">
                @foreach ($pengampu as $row)
                <input type="hidden" name="pengampu_id" id="pengampu_id" value="{{$row->id}}"/>
                @endforeach
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
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Penilaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('walikelas.penilaian.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                       
                        <div class="form-group">
                            <label for="edit-judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="edit-judul" required />
                        </div>
                        <div class="form-group">
                        <label for="edit-kategori"> Kategori</label>
                            <select name="kategori" id="edit-kategori" class="form-control">
                                <option value="">Pilih Kategori</option>
                            <option value="Absen">Absen</option>
                            <option value="Tugas">Tugas</option>
                            <option value="Praktikum">Praktikum</option>
                            <option value="UTS">UTS</option>
                            <option value="UAS">UAS</option>
                            </select>
                        </div>
                        </div>
                        

                <div class="modal-footer">
                @foreach ($pengampu as $row)
                <input type="hidden" name="pengampu_id" id="pengampu_id" value="{{$row->id}}"/>
                @endforeach
                <input type="hidden" name="kode" id="edit-kode" />
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
                url: "{{ url('/admin/ajaxadmin/dataPenilaian') }}/" + id,
                dataType: 'json',
                success: function(res) {
                    $('#edit-judul').val(res.judul);
                    $('#edit-kategori').val(res.kategori);
                    $('#edit-kode').val(res.kode);
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
                    url: "delete/" + npm,
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