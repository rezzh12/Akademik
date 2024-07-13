@extends('admin.layouts.master')
@section('title','Dashboard')
@section('judul','Dashboard')

@section('content')
    <div class="container-fluid">
                    <table id="datatable" class="table table-white table-responsive-lg">
                    @foreach ($nilai as $row)
                        <tbody>
                            <tr>
                                <td>Tahun Akademik</td>
                                <td>:{{ $row->akademik->tahun_akademik }} </td>
                            </tr>
                            <tr>
                                <td>Semester</td>
                                <td>:{{ $row->akademik->semester }}</td>
                            </tr>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td>:{{ $row->mapel->nama_mapel }}</td>
                            </tr>
                            <tr>
                                <td>Mata Pelajaran</td>
                                <td>:{{ $row->kelas->nama_kelas }}</>
                            </tr>
                        </tbody>
                        @endforeach
                    </table>
                    </div>
                    <hr />

                    <div>
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Nilai Siswa') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahRiwayatModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                            <th>Lihat</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($riwayat as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{ $row->NISN }}</td>
                                <td >{{ $row->siswa->nama_lengkap }}</td>
                                <td >{{ $row->nilai }}</td>
                                <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-riwayat" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahRiwayatModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation( '{{ $row->id }}', '{{ $row->siswa->nama_lengkap }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                                <td>
                                <a href="tampil/{{ $row->NISN }}"><i class="fa fa-eye"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<!-- Tambah Mapel -->
<div class="modal fade" id="tambahRiwayatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Riwayat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.riwayat.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="Nilai">Nilai</label>
                            <input type="number" class="form-control" name="Nilai" id="Nilai" required />
                        </div>
                        </div>
                        
                <div class="modal-footer">
                @foreach ($nilai as $row)
                <input type="hidden" name="nilai_id" id="nilai_id" value="{{$row->id}}" />
                @endforeach
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahRiwayatModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Riwayat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.riwayat.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-NISN">NISN</label>
                            <input type="text" class="form-control" name="NISN" id="edit-NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-Nilai">Nilai</label>
                            <input type="number" class="form-control" name="Nilai" id="edit-Nilai" required />
                        </div>
                        </div>
                        

                <div class="modal-footer">
                @foreach ($nilai as $row)
                <input type="hidden" name="nilai_id" id="nilai_id" value="{{$row->id}}" />
                @endforeach
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
 
    @stop
   

    @section('js')
    <script>
        //EDIT
        $(function() {
            $(document).on('click', '#btn-edit-riwayat', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataRiwayat') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NISN').val(res.NISN);
                        $('#edit-Nilai').val(res.nilai);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        function deleteConfirmation( npm, judul) {
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