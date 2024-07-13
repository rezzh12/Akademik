@extends('admin.layouts.master')

@section('title', 'Data Riwayat Tindakan')
@section('judul', 'Data Riwayat Tindakan')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Riwayat Tindakan') }}</div>
            <div class="card-body">
            <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link " aria-current="page" href="{{ route('admin.tindakan') }}">Data Tindakan Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('admin.RTindakan') }}">Data Riwayat Tindakan</a>
            </li>
            </ul>
            <hr />
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahMasukModal"><i class="fa fa-plus"></i>
                    Tambah Data</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Pelapor</th>
                            <th>Siswa</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Skor</th>
                            <th>Foto</th>
                            <th>Deskripsi</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($RTindakan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->guru->nama_lengkap}}</td>
                                <td>{{ $row->siswa->nama_lengkap}}</td>
                                <td>{{ $row->judul }}</td>
                                <td>{{ $row->kategori}}</td>
                                <td>{{ $row->skor}}</td>
                                <td>
                                    @if ($row->foto !== null)
                                        <img src="{{ asset('storage/tindakan/' . $row->foto) }}" width="100px" />
                                    @else
                                        [Gambar tidak tersedia]
                                    @endif
                                </td>
                                <td>{{ $row->deskripsi}}</td>
                                
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jadwal" class="btn btn-success"
                                            data-toggle="modal" data-target="#editMasukModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                            <button class="btn btn-xs"></button>
                                            <button type="button" class="btn btn-danger"
                                            onclick="deleteConfirmation('{{ $row->id }}', '{{ $row->kode }}' )"><i class="fa fa-times"></i></button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Tambah Jadwal -->
    <div class="modal fade" id="tambahMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Riwayat Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.RTindakan.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                        <label for="barang">Nama</label>
                        <input type="text" name="NISN" id="barang" class="form-control" placeholder="Masukan Nama Siswa" />
                        <div id="listbarang"></div>
                        </div>
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="judul" required />
                        </div>
                        <div class="form-group">
                            <label for="kategori">Kategori</label>
                            <select name="kategori" id="kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sangat Ringan">Sangat Ringan </option>
                                <option value="Ringan">Ringan</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Berat">Berat</option>
                                <option value="Sangat Berat">Sangat Berat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="skor">Skor</label>
                            <input type="number" class="form-control" name="skor" id="skor" required />
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>
                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="deskripsi"  rows="3"></textarea>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--Ubah Data-->
     <!-- UBAH DATA -->
     <div class="modal fade" id="editMasukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Riwayat Tindakan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.RTindakan.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                        <label for="edit-barang">Nama</label>
                        <input type="text" name="NISN" id="edit-barang" class="form-control" placeholder="Masukan Nama Siswa" readonly/>
                        <div id="listbarang"></div>
                        </div>
                        <div class="form-group">
                            <label for="edit-judul">Judul</label>
                            <input type="text" class="form-control" name="judul" id="edit-judul" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-kategori">Kategori</label>
                            <select name="kategori" id="edit-kategori" class="form-control" required>
                                <option value="">Pilih Kategori</option>
                                <option value="Sangat Ringan">Sangat Ringan </option>
                                <option value="Ringan">Ringan</option>
                                <option value="Sedang">Sedang</option>
                                <option value="Berat">Berat</option>
                                <option value="Sangat Berat">Sangat Berat</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit-skor">Skor</label>
                            <input type="number" class="form-control" name="skor" id="edit-skor" required />
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" id="foto" required />
                        </div>
                        <div class="form-group">
                            <label for="edit-deskripsi">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="edit-deskripsi"  rows="3"></textarea>
                        </div>
                        </div>

                <div class="modal-footer">
                <input type="hidden" name="kode" id="edit-kode" />
                <input type="hidden" name="akademik" id="edit-akademik" />
                <input type="hidden" name="NUPTK" id="edit-NUPTK" />
                <input type="hidden" name="foto_lama" id="edit-foto_lama" />
                <input type="hidden" name="id" id="edit-id" />
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @stop

    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
$(function() {
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/ajaxadmin/dataRTindakan') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-NUPTK').val(res.NUPTK);
                        $('#edit-barang').val(res.NISN);
                        $('#edit-judul').val(res.judul);
                        $('#edit-kategori').val(res.kategori);
                        $('#edit-skor').val(res.skor);
                        $('#edit-deskripsi').val(res.deskripsi);
                        $('#edit-akademik').val(res.tahun_akademik_id);
                        $('#edit-foto_lama').val(res.foto);
                        $('#edit-kode').val(res.kode);
                        $('#edit-id').val(res.id);
                    },
                });
            });
        });

        @if(session('status'))
            Swal.fire({
                title: 'Congratulations!',
                text: "{{ session('status') }}",
                icon: 'Success',
                timer: 3000
            })
        @endif
        @if($errors->any())
            @php
                $message = '';
                foreach($errors->all() as $error)
                {
                    $message .= $error."<br/>";
                }
            @endphp
            Swal.fire({
                title: 'Error',
                html: "{!! $message !!}",
                icon: 'error',
            })
        @endif
        
        function deleteConfirmation(npm, judul) {
            swal.fire({
                title: "Hapus?",
                type: 'warning',
                text: "Apakah anda yakin akan menghapus data dengan kode " + judul + "?!",

                showCancelButton: !0,
                confirmButtonText: "Ya, lakukan!",
                cancelButtonText: "Tidak, batalkan!",
                reverseButtons: !0
            }).then(function(e) {

                if (e.value === true) {
                    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        type: 'POST',
                        url: "RTindakan/delete/" + npm,
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
        
        $(document).ready(function() {
            $('#edit-nik').prop('disabled',true);
$('#barang').keyup(function() {
    var query = $(this).val();
    if (query != '') {
        var _token = $('input[name="csrf-token"]').val();
        $.ajax({
            url: "{{ url('admin/RTindakan/fetch') }}",
            method: "GET",
            data: {
                query: query,
                _token: _token
            },
            success: function(data) {
                $('#listbarang').fadeIn();
                $('#listbarang').html(data);
            }
        });
    }
});
});

$(document).on('click', 'li', function() {
    $('#barang').val($(this).text());
    $('#listbarang').fadeOut();

  
});
        </script>
    @stop