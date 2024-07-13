@extends('TU.layouts.master')
@section('title','Data Siswa')
@section('judul','Data Siswa')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Data Siswa') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahSiswaModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
            
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tanggal Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Agama</th>
                            <th>Kelas</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($siswa as $row)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td class="text-center">{{ $row->NISN }}</td>
                                <td class="text-center">{{ $row->nama_lengkap }}</td>
                                <td class="text-center">{{ $row->gender }}</td>
                                <td class="text-center">{{ $row->tanggal_lahir }}</td>
                                <td class="text-center">{{ $row->tempat_lahir }}</td>
                                <td class="text-center">{{ $row->agama }}</td>
                                <td class="text-center">{{ $row->kelas->nama_kelas }}</td>
                                <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-siswa" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahSiswaModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama_lengkap }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

 <!-- Tambah Siswa -->
    <div class="modal fade" id="tambahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('TU.siswa.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="NISN">NISN</label>
                            <input type="number" class="form-control" name="NISN" id="NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        </div>
                     
                        <div class="form-group">
                        <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
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

     <!-- Ubah Siswa -->
     <div class="modal fade" id="ubahSiswaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Siswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('TU.siswa.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                       
                        <div class="form-group">
                            <label for="edit-NISN">NISN</label>
                            <input type="number" class="form-control" name="NISN" id="edit-NISN" required readonly/>
                        </div>
                        <div class="form-group">
                            <label for="edit-nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
                        </div> 
                        <div class="form-group">
                        <label for="edit-kelas">Kelas</label>
                            <select name="kelas" id="edit-kelas" class="form-control">
                                <option value="">Pilih Kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->nama_kelas}}</option>
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
            $(document).on('click', '#btn-edit-siswa', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/TU/ajaxadmin/dataSiswa') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NISN').val(res.NISN);
                        $('#edit-nama').val(res.nama_lengkap);
                        $('#edit-kelas').val(res.kelas_id);
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
                        url: "data_siswa/delete/" + npm,
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