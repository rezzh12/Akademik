@extends('TU.layouts.master')
@section('title', 'Input Pendaftar')
@section('judul', 'Input Pendaftar')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">Data Pendaftar</div>

                <div class="card-body">
                <form method="post" action="{{ route('TU.pendaftaran.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="NISN">NISN</label>
                            <input type="number" class="form-control" name="NISN" id="NISN" required />
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama Lengkap</label>
                            <input type="text" class="form-control" name="nama" id="nama" required /> 
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin" id="jenis_kelamin" required>
                            <option value="">Pilih Jenis Kelamin</option>
                            <option value="Pria">Pria</option>
                            <option value="Wanita">Wanita </option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <select class="form-control" name="agama" id="agama" required>
                            <option value="">Pilih Agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen </option>
                            <option value="Katolik">Katolik </option>
                            <option value="Hindu">Hindu </option>
                            <option value="Buddha">Buddha </option>
                            <option value="Khonghucu">Khonghucu </option>
                            <option value="Lainnya">Lainnya </option>
                           </select>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" id="email" required />
                        </div>
                       
                       
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control" name="tempat_lahir" id="tempat_lahir" required />
                        </div>
                        <div class="form-group">
                            <label for="tanggal_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir" required />
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" required />
                        </div>
                       
                        <div class="form-group">
                            <label for="jurusan">Jurusan</label>
                            <select class="form-control" name="jurusan" id="jurusan" required>
                            <option value="">Pilih Jurusan</option>
                                @foreach($jurusan as $ps)
                                <option value="{{$ps->id}}">{{$ps->nama_jurusan}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="pas_foto">Pas Foto</label>
                            <input type="file" class="form-control" name="pas_foto" id="pas_foto" required />
                        </div>
                        </div>
                        </div>
                </div>
                
            </div>
            <div class="card">
                <div class="card-header">Data Orang Tua</div>
                <div class="card-body">
                    
                        <div class="row">
                        <div class="col-md-6">
                            
                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control" name="nama_ayah" id="nama_ayah" required />
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_ayah">Pekerjaan Ayah</label>
                            <input type="text" class="form-control" name="pekerjaan_ayah" id="pekerjaan_ayah" required />
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP</label>
                            <input type="number" class="form-control" name="no_hp" id="no_hp" required />
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control" name="nama_ibu" id="nama_ibu" required />
                        </div>
                        <div class="form-group">
                            <label for="pekerjaan_Ibu">Pekerjaan Ibu</label>
                            <input type="text" class="form-control" name="pekerjaan_Ibu" id="pekerjaan_Ibu" required />
                        </div>
                        <div class="form-group">
                            <label for="no_hp">No HP Orang Tua</label>
                            <input type="number" class="form-control" name="no_hp_ortu" id="no_hp_ortu" required />
                        </div>
                        </div>

                      
                </div>
                
            </div>

            <div class="card">
                <div class="card-header">Data Sekolah</div>

                <div class="card-body">
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="asal_sekolah">Asal Sekolah</label>
                            <input type="text" class="form-control" name="asal_sekolah" id="asal_sekolah" required />
                        </div>
                        <div class="form-group">
                            <label for="alamat_sekolah">Alamat Sekolah</label>
                            <input type="text" class="form-control" name="alamat_sekolah" id="alamat_sekolah" required />
                        </div>
                        <div class="form-group">
                            <label for="kk">Kartu Keluarga</label>
                            <input type="file" class="form-control" name="kk" id="kk" required />
                        </div>
                       
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="nilai_raport">Nilai Raport</label>
                            <input type="file" class="form-control" name="nilai_raport" id="nilai_raport" required />
                        </div>
                        <div class="form-group">
                            <label for="ijazah">Ijazah</label>
                            <input type="file" class="form-control" name="ijazah" id="ijazah" required />
                        </div>
                        <div class="form-group">
                            <label for="prestasi">Prestasi</label>
                            <input type="file" class="form-control" name="prestasi" id="prestasi"/>
                        </div>
                </div>
                
            </div>


            <div class="modal-footer">
            <input type="hidden" name="id_login" id="id_login" value="{{ Auth::user()->id }}" />
            <a href="{{ URL::previous() }}" class="btn btn-default">Kembali</a>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                    </form>
                </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
@stop