@extends('kepala.layouts.master')

@section('title', 'Data Tindakan Kelas')
@section('judul', 'Data Tindakan Kelas')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Tindakan Kelas') }}</div>
            <div class="card-body">
            <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('kepala.tindakan') }}">Data Tindakan Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('kepala.RTindakan') }}">Data Riwayat Tindakan</a>
            </li>
            </ul>
            <hr />
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Laporan</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Siswa</th>
                            <th>Kelas</th>
                            <th>Skor Akhir</th>
                            <th>Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $no=1; @endphp
                        @foreach ($tindakan as $row)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $row->NISN }}</td>
                                <td>{{ $row->siswa->nama_lengkap}}</td>
                                <td>{{ $row->kelas->nama_kelas}}</td>
                                <td>{{ $row->skor }}</td>
                                <td> @if($row->tindakan == null)
                                    @else
                                    Tindakan {{ $row->tindakan }}
                                    @endif
                                </td>
                                
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="tambahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('kepala.tindakan.laporan') }}" enctype="multipart/form-data">
                        @csrf
                       
                        <div class="form-group">
                            <label for="dari_tanggal">Dari Tanggal</label>
                            <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" required />
                        </div>
                        <div class="form-group">
                            <label for="sampai_tanggal">Sampai Tanggal</label>
                            <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" required />
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
    @stop

    @section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
$(function() {
            $(document).on('click', '#btn-edit-jadwal', function() {
                let id = $(this).data('id');
                $.ajax({
                    type: "get",
                    url: "{{ url('admin/prasarana/ajaxadmin/dataPrasarana') }}/" + id,
                    dataType: 'json',
                    success: function(res) {
                        $('#edit-tanggal').val(res.tanggal);
                        $('#edit-ada').val(res.jumlah_ada);
                        $('#edit-kondisi').val(res.kondisi);
                        $('#edit-diperlukan').val(res.jumlah_diperlukan);
                        $('#edit-keterangan').val(res.keterangan);
                        $('#edit-ruangan').val(res.ruangan_id);
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
                        url: "prasarana/delete/" + npm,
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