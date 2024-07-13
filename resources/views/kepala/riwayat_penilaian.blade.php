@extends('kepala.layouts.master')
@section('title','Data Penilaian')
@section('judul','Data Penilaian')

@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Data Penilaian') }}</div>
            <div class="card-body">
            <button class="btn btn-primary" data-toggle="modal" data-target="#tambahJurusanModal"><i class="fa fa-plus"></i>
                    Laporan</button>
                    <hr />
                <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>Tanggal</th>
                            <th>Nama Guru</th>
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
                            <td >{{ $row->nama_lengkap }}</td>
                            <td >{{ $row->judul }}</td>
                            <td >{{ $row->kategori }}</td>
                           
                            <td >
                                <a href="riwayat_penilaian/{{ $row->id }}"><i class="fa fa-eye">Lihat</i></a></td>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data Laporan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('kepala.penilaian.laporan') }}" enctype="multipart/form-data">
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