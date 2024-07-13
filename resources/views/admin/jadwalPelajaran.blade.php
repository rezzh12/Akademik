@extends('admin.layouts.master')
@section('title','Data Jadwal Pelajaran')
@section('judul','Data Jadwal Pelajaran')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Jadwal Pelajaran') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJadwalModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
            
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>Mata Pelajaran</th>
                            <th>Guru</th>
                            <th>Kelas</th>
                            <th>Hari</th>
                            <th>Jam</th>
                            <th>Semester</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($jadwal as $row)
                            <tr>
                                <td >{{ $no++ }}</td>
                                <td >{{$row->mapel->nama_mapel}}</td>
                                <td >{{$row->guru->nama_lengkap}}</td>
                                <td >{{$row->kelas->nama_kelas}}</td>
                                <td >{{$row->hari}}</td>
                                <td >{{$row->jam}}</td>
                                <td >{{$row->kurikulum->semester}}</td>
                                <td >
                                <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jadwal" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJadwalModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->mapel->nama_mapel }}' )"><i class="fa fa-times"></i></button>
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
 <div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jadwal.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="kurikulum">Kurikulum</label>
                            <select name="kurikulum" id="kurikulum" class="form-control">
                                <option value="">Pilih Kurikulum</option>
                                @foreach($kurikulum as $kr)
                            <option value="{{$kr->id}}">{{$kr->nama_kurikulum}} {{$kr->semester}}</option>
                            @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                        <label for="kelas">Kelas</label>
                            <select name="kelas" id="kelas" class="form-control">
                                <option value="">Pilih kelas</option>
                                @foreach($kelas as $ks)
                            <option value="{{$ks->id}}">{{$ks->tingkatan_kelas}} {{$ks->nama_kelas}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="guru">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->id}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="mapel">Mapel</label>
                            <select name="mapel" id="mapel" class="form-control">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
                            </select>
                        </div>
                      
                        <div class="form-group">
                        <label for="jam">Jam</label>
                            <select name="jam" id="jam" class="form-control">
                                <option value="">Pilih Jam</option>
                                <option value="07.15 - 08.00">07.15 - 08.00</option>
                                <option value="08.00 - 08.45">08.00 - 08.45</option>
                                <option value="08.45 - 09.30">08.45 - 09.30</option>
                                <option value="10.45 - 11.30">10.45 - 11.30</option>
                                <option value="11.30 - 12.15">11.30 - 12.15</option>
                                <option value="12.15 - 13.30">12.15 - 13.30</option>
                                <option value="13.30 - 14.15">13.30 - 14.15</option>
                                <option value="14.15 - 15.00">14.15 - 15.00</option>
                            </select>
                        </div>
                      
                        <div class="form-group">
                        <label for="hari">Hari</label>
                            <select name="hari" id="hari" class="form-control">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                            </select>
                        </div>
                        </div>
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
     <div class="modal fade" id="ubahJadwalModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Jadwal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.jadwal.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="edit-kurikulum">Kurikulum</label>
                            <select name="kurikulum" id="edit-kurikulum" class="form-control">
                                <option value="">Pilih Kurikulum</option>
                                @foreach($kurikulum as $kr)
                            <option value="{{$kr->id}}">{{$kr->nama_kurikulum}} {{$kr->semester}}</option>
                            @endforeach
                            </select>
                     
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
                            <option value="{{$gr->id}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="edit-mapel">Mapel</label>
                            <select name="mapel" id="edit-mapel" class="form-control">
                                <option value="">Pilih Mapel</option>
                                @foreach($mapel as $ml)
                            <option value="{{$ml->id}}">{{$ml->nama_mapel}}</option>
                            @endforeach
                            </select>
                        </div>
                       
                        <div class="form-group">
                        <label for="edit-jam">Jam</label>
                            <select name="jam" id="edit-jam" class="form-control">
                                <option value="">Pilih Jam</option>
                                <option value="07.15 - 08.00">07.15 - 08.00</option>
                                <option value="08.00 - 08.45">08.00 - 08.45</option>
                                <option value="08.45 - 09.30">08.45 - 09.30</option>
                                <option value="10.45 - 11.30">10.45 - 11.30</option>
                                <option value="11.30 - 12.15">11.30 - 12.15</option>
                                <option value="12.15 - 13.30">12.15 - 13.30</option>
                                <option value="13.30 - 14.15">13.30 - 14.15</option>
                                <option value="14.15 - 15.00">14.15 - 15.00</option>
                            </select>
                        </div>
                     
                        <div class="form-group">
                        <label for="edit-hari">Hari</label>
                            <select name="hari" id="edit-hari" class="form-control">
                                <option value="">Pilih Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jum'at">Jum'at</option>
                            </select>
                        </div>
                        </div>
                        </div>
                        

                </div>
                <div class="modal-footer">
                <input type="hidden" name="gurus" id="edit-gurus" />
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
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataJadwal') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-akademik').val(res.tahun_akademik_id);
                        $('#edit-kurikulum').val(res.kurikulum_id);
                        $('#edit-semester').val(res.semester);
                        $('#edit-jurusan').val(res.jurusan_id);
                        $('#edit-tingkatan').val(res.tingkatan__kelas_id);
                        $('#edit-kelas').val(res.kelas_id);
                        $('#edit-mapel').val(res.mapel_id);
                        $('#edit-guru').val(res.guru_id);
                        $('#edit-gurus').val(res.guru_id);
                        $('#edit-jam').val(res.jam);
                        $('#edit-ruangan').val(res.ruangan_id);
                        $('#edit-hari').val(res.hari);
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
                        url: "jadwal/delete/" + npm,
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