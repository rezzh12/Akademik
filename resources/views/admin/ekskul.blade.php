@extends('admin.layouts.master')
@section('title', 'Data Ekskul')
@section('judul', 'Data Ekskul')
@section('content')
    <div class="container-fluid">
   
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Ekskul') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahNilaiModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Nama Guru</th>
                            <th>Nama Ekskul</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                            <th>Lihat Nilai</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($ekskul as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->guru->nama_lengkap }}</td>
                            <td >{{ $row->nama}}</td>
                            <td>@if ($row->foto !== null)
                                        <img src="{{ asset('storage/ekskul/' . $row->foto) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif</td>
                            <td >{{ $row->deskripsi}}</td>
                            <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-nilai" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahNilaiModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->nama }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            <td >
                                <a href="riwayat_ekskul/{{ $row->id }}"><i class="fa fa-eye"></i></a></td>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>

    <!-- Tambah Mapel -->
<div class="modal fade" id="tambahNilaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Ekskul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.ekskul.submit') }}" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="form-group">
                        <label for="guru">Guru</label>
                            <select name="guru" id="guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="nama">Nama Ekskul</label>
                            <input type="text" class="form-control" name="nama" id="nama" required />
                        
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


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahNilaiModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Ekskul</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.ekskul.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                      
                        <div class="form-group">
                        <label for="edit-guru">Guru</label>
                            <select name="guru" id="edit-guru" class="form-control">
                                <option value="">Pilih Guru</option>
                                @foreach($guru as $gr)
                            <option value="{{$gr->NUPTK}}">{{$gr->nama_lengkap}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                        <label for="edit-nama">Nama Ekskul</label>
                            <input type="text" class="form-control" name="nama" id="edit-nama" required />
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
                <input type="hidden" name="id" id="edit-id" />
                <input type="hidden" name="akademik" id="edit-akademik" />
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
            $(document).on('click', '#btn-edit-nilai', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/ajaxadmin/dataEkskul') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-akademik').val(res.tahun_akademik_id);
                        $('#edit-guru').val(res.NUPTK);
                        $('#edit-nama').val(res.nama);
                        $('#edit-deskripsi').val(res.deskripsi);
                        $('#edit-old_foto').val(res.foto);
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
                        url: "ekskul/delete/" + npm,
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