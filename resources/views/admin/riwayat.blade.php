@extends('admin.layouts.master')
@section('title','Data Riwayat Penilaian')
@section('judul','Data Riwayat Penilaian')

@section('content')
    <div class="container-fluid">
    <table id="datatabel" class="table table-striped table-white table-responsive-lg">
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
            <div class="card-header">{{ __('Data Riwayat Penilaian') }}</div>
            <div class="card-body">
                <table id="table-data" class="table table-striped table-white">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Keterangan</th>
                            <th>Nilai</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($riwayat as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->NISN }}</td>
                            <td >{{ $row->siswa->nama_lengkap }}</td>
                            <td >{{ $row->keterangan }}</td>
                            <td >{{ $row->skor }}</td>
                           
                            <td >
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" id="btn-edit-jurusan" class="btn btn-xs btn-success"
                                            data-toggle="modal" data-target="#ubahJurusanModal"
                                            data-id="{{ $row->id }}"><i class="fa fa-edit"></i></button>
                                    </div>
                        </tr>
                                @endforeach
                    </tbody>
                </table>
            </div>
        </div>

     <!-- Ubah Jurusan -->
     <div class="modal fade" id="ubahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        @foreach ($riwayats as $row)
                        @if($row->kategori == "Absen")
                        <div class="form-group">
                        <label for="edit-keterangan"> Keterangan</label>
                            <select name="keterangan" id="edit-keterangan" class="form-control">
                                <option value="">Pilih Keterangan</option>
                            <option value="Hadir">Hadir</option>
                            <option value="Absen">Absen</option>
                            <option value="Izin">Izin</option>
                            <option value="Sakit">Sakit</option>
                            </select>
                            </div>
                        @else
                        <div class="form-group">
                            <label for="edit-skor">Skor</label>
                            <input type="text" class="form-control" name="skor" id="edit-skor" required />
                        </div>
                        
                       @endif
                       @endforeach
                       </div>
                <div class="modal-footer">
                <input type="hidden" name="akademik" id="edit-akademik" />
                <input type="hidden" name="NISN" id="edit-NISN" />
                <input type="hidden" name="kategori" id="edit-kategori" />
                <input type="hidden" name="penilaian" id="edit-penilaian" />
                <input type="hidden" name="pengampu" id="edit-pengampu" />
                <input type="hidden" name="kurikulum" id="edit-kurikulum" />
                <input type="hidden" name="mapel" id="edit-mapel" />
                <input type="hidden" name="kelas" id="edit-kelas" />
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
<script>
    //EDIT
    $(function() {
        $(document).on('click', '#btn-edit-jurusan', function() {
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: "{{ url('/admin/ajaxadmin/dataRiwayatNilai') }}/" + id,
                dataType: 'json',
                success: function(res) {
                    $('#edit-keterangan').val(res.keterangan);
                    $('#edit-skor').val(res.skor);
                    $('#edit-akademik').val(res.tahun_akademik_id);
                    $('#edit-NISN').val(res.NISN);
                    $('#edit-kategori').val(res.kategori);
                    $('#edit-penilaian').val(res.penilaian_id);
                    $('#edit-kurikulum').val(res.kurikulum_id);
                    $('#edit-pengampu').val(res.pengampu_id);
                    $('#edit-mapel').val(res.mapel_id);
                    $('#edit-kelas').val(res.kelas_id);
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