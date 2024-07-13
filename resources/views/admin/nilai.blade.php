@extends('admin.layouts.master')
@section('title','Data Nilai')
@section('judul','Data Nilai')

@section('content')
    <div class="container-fluid">
    <div>
    <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    @foreach ($pengampu1 as $row)
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
            <div class="card-header">{{ __('Data Nilai') }}</div>
            <div class="card-body">
            <table id="table-data" class="table table-striped table-white table-responsive-lg">
                    <thead>
                        <tr >
                            <th>NO</th>
                            <th>NISN</th>
                            <th>Nama</th>
                            <th>Nilai</th>
                            <th>Ketercapaian</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @php $no=1; @endphp
                        @foreach ($nilai as $row)
                        <tr>
                            <td >{{ $no++ }}</td>
                            <td >{{ $row->NISN }}</td>
                            <td >{{ $row->siswa->nama_lengkap }}</td>
                            <td >{{ $row->nilai }}</td>
                            <td >{{ $row->ketercapaian }}</td>
                            <td >{{ $row->deskripsi }}</td>
                           
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
    </div>
    </div>


     <!-- Ubah Tingkatan -->
     <div class="modal fade" id="ubahJurusanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ubah Data Nilai</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('admin.hasil.update') }}" enctype="multipart/form-data">
                    @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label for="edit-nilai">Nilai</label>
                            <input type="number" class="form-control" name="nilai" id="edit-nilai" readonly />
                        </div>
                        <div class="form-group">
                            <label for="edit-ketercapaian">Nilai</label>
                            <input type="text" class="form-control" name="ketercapaian" id="edit-ketercapaian" readonly />
                        </div>
                        <div class="form-group">
                            <label for="edit-deskripsi">Deskripsi</label>
                            <textarea class="form-control" type="text" name="deskripsi" id="edit-deskripsi"  rows="3"></textarea>
                        </div>
                        </div>
                        

                <div class="modal-footer">
                <input type="hidden" name="akademik" id="edit-akademik" />
                <input type="hidden" name="tanggal" id="edit-tanggal" />
                <input type="hidden" name="NISN" id="edit-NISN" />
                <input type="hidden" name="sakit" id="edit-sakit" />
                <input type="hidden" name="izin" id="edit-izin" />
                <input type="hidden" name="alfa" id="edit-alfa" />
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
 
    @stop

@section('js')
<script>
    //EDIT
    $(function() {
        $(document).on('click', '#btn-edit-jurusan', function() {
            let id = $(this).data('id');
            $.ajax({
                type: "get",
                url: "{{ url('/admin/ajaxadmin/dataNilaiHasil') }}/" + id,
                dataType: 'json',
                success: function(res) {
                    $('#edit-tanggal').val(res.tanggal);
                    $('#edit-nilai').val(res.nilai);
                    $('#edit-deskripsi').val(res.deskripsi);
                    $('#edit-ketercapaian').val(res.ketercapaian);
                    $('#edit-akademik').val(res.tahun_akademik_id);
                    $('#edit-NISN').val(res.NISN);
                    $('#edit-kurikulum').val(res.kurikulum_id);
                    $('#edit-mapel').val(res.mapel_id);
                    $('#edit-kelas').val(res.kelas_id);
                    $('#edit-izin').val(res.Izin);
                    $('#edit-sakit').val(res.Sakit);
                    $('#edit-alfa').val(res.Alfa);
                    $('#edit-id').val(res.id);
                },
            });
        });
    });

    
    </script>
@stop