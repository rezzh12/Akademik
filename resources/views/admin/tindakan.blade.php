@extends('admin.layouts.master')

@section('title', 'Data Tindakan Kelas')
@section('judul', 'Data Tindakan Kelas')
@section('content')
    <div class="container-fluid">
        <div class="card card-default">
            <div class="card-header">{{ __('Pengelolaan Tindakan Kelas') }}</div>
            <div class="card-body">
            <ul class="nav nav-pills">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="{{ route('admin.tindakan') }}">Data Tindakan Kelas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link " href="{{ route('admin.RTindakan') }}">Data Riwayat Tindakan</a>
            </li>
            </ul>
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
                            <th>AKSI</th>
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
                                <td>{{ $row->tindakan}}</td>
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