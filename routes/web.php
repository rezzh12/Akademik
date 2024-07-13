<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


    Route::get('/',
    [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('/home',
    [App\Http\Controllers\HomeController::class, 'index1'])->name('home1');
    Route::get('register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store']);
    

Auth::routes();
Route::get('admin/home',
    [App\Http\Controllers\AdminController::class, 'index'])->name('admin.home')->middleware('admin');
    Route::get('admin/jurusan',
        [App\Http\Controllers\AdminController::class, 'jurusan'])->name('admin.jurusan')->middleware('admin');
    Route::post('admin/jurusan', 
        [App\Http\Controllers\AdminController::class, 'submit_jurusan'])->name('admin.jurusan.submit')->middleware('admin');
    Route::patch('admin/jurusan/update', 
        [App\Http\Controllers\AdminController::class, 'update_jurusan'])->name('admin.jurusan.update')->middleware('admin');
    Route::get('admin/ajaxadmin/dataJurusan/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataJurusan']);
    Route::post('admin/jurusan/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_jurusan'])->name('admin.jurusan.delete')->middleware('admin');

    Route::get('admin/kelas',
        [App\Http\Controllers\AdminController::class, 'kelas'])->name('admin.kelas')->middleware('admin');
    Route::post('admin/kelas', 
        [App\Http\Controllers\AdminController::class, 'submit_kelas'])->name('admin.kelas.submit')->middleware('admin');
    Route::patch('admin/kelas/update', 
        [App\Http\Controllers\AdminController::class, 'update_kelas'])->name('admin.kelas.update')->middleware('admin');
    Route::get('admin/ajaxadmin/dataKelas/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataKelas']);
    Route::post('admin/kelas/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_kelas'])->name('admin.kelas.delete')->middleware('admin');

    Route::get('admin/mapel',
        [App\Http\Controllers\AdminController::class, 'mapel'])->name('admin.mapel')->middleware('admin');
    Route::post('admin/mapel', 
        [App\Http\Controllers\AdminController::class, 'submit_mapel'])->name('admin.mapel.submit')->middleware('admin');
    Route::patch('admin/mapel/update', 
        [App\Http\Controllers\AdminController::class, 'update_mapel'])->name('admin.mapel.update')->middleware('admin');
    Route::get('admin/ajaxadmin/dataMapel/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataMapel']);
    Route::post('admin/mapel/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_mapel'])->name('admin.mapel.delete')->middleware('admin');

Route::get('admin/akademik',
    [App\Http\Controllers\AdminController::class, 'akademik'])->name('admin.akademik')->middleware('admin');
Route::post('admin/akademik', 
    [App\Http\Controllers\AdminController::class, 'submit_akademik'])->name('admin.akademik.submit')->middleware('admin');
Route::patch('admin/akademik/update', 
    [App\Http\Controllers\AdminController::class, 'update_akademik'])->name('admin.akademik.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataAkademik/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataAkademik']);
Route::post('admin/akademik/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_akademik'])->name('admin.akademik.delete')->middleware('admin');

    Route::get('admin/kurikulum',
        [App\Http\Controllers\AdminController::class, 'kurikulum'])->name('admin.kurikulum')->middleware('admin');
    Route::post('admin/kurikulum', 
        [App\Http\Controllers\AdminController::class, 'submit_kurikulum'])->name('admin.kurikulum.submit')->middleware('admin');
    Route::patch('admin/kurikulum/update', 
        [App\Http\Controllers\AdminController::class, 'update_kurikulum'])->name('admin.kurikulum.update')->middleware('admin');
    Route::get('admin/ajaxadmin/dataKurikulum/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataKurikulum']);
    Route::post('admin/kurikulum/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_kurikulum'])->name('admin.kurikulum.delete')->middleware('admin');

   
    Route::get('admin/jadwal',
        [App\Http\Controllers\AdminController::class, 'jadwal'])->name('admin.jadwal')->middleware('admin');
    Route::post('admin/jadwal', 
        [App\Http\Controllers\AdminController::class, 'submit_jadwal'])->name('admin.jadwal.submit')->middleware('admin');
    Route::patch('admin/jadwal/update', 
        [App\Http\Controllers\AdminController::class, 'update_jadwal'])->name('admin.jadwal.update')->middleware('admin');
    Route::get('admin/ajaxadmin/dataJadwal/{id}', 
        [App\Http\Controllers\AdminController::class, 'getDataJadwal']);
    Route::post('admin/jadwal/delete/{id}',
        [App\Http\Controllers\AdminController::class, 'delete_jadwal'])->name('admin.jadwal.delete')->middleware('admin');


Route::get('admin/walikelas',
    [App\Http\Controllers\AdminController::class, 'walikelas'])->name('admin.walikelas')->middleware('admin');
Route::post('admin/walikelas', 
    [App\Http\Controllers\AdminController::class, 'submit_walikelas'])->name('admin.walikelas.submit')->middleware('admin');
Route::patch('admin/walikelas/update', 
    [App\Http\Controllers\AdminController::class, 'update_walikelas'])->name('admin.walikelas.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataWalikelas/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataWalikelas']);
Route::post('admin/walikelas/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_walikelas'])->name('admin.walikelas.delete')->middleware('admin');
    
Route::get('admin/pengampu',
    [App\Http\Controllers\AdminController::class, 'pengampu'])->name('admin.pengampu')->middleware('admin');
Route::get('admin/penilaian/{id}',
    [App\Http\Controllers\AdminController::class, 'penilaian'])->name('admin.penilaian')->middleware('admin');
Route::post('admin/penilaian', 
    [App\Http\Controllers\AdminController::class, 'submit_penilaian'])->name('admin.penilaian.submit')->middleware('admin');
Route::patch('admin/penilaian/update', 
    [App\Http\Controllers\AdminController::class, 'update_penilaian'])->name('admin.penilaian.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataPenilaian/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataPenilaian']);
Route::post('admin/penilaian/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_penilaian'])->name('admin.penilaian.delete')->middleware('admin');
Route::get('admin/penilaian/riwayat/{id}',
    [App\Http\Controllers\AdminController::class, 'riwayat_penilaian'])->name('admin.riwayat.penilaian')->middleware('admin');

Route::get('admin/riwayat/{id}',
    [App\Http\Controllers\AdminController::class, 'riwayat'])->name('admin.riwayat')->middleware('admin');
Route::patch('admin/riwayat/update', 
    [App\Http\Controllers\AdminController::class, 'update_riwayat'])->name('admin.riwayat.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataRiwayatNilai/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataRiwayat']);

Route::get('admin/hasil/{id}',
    [App\Http\Controllers\AdminController::class, 'hasil'])->name('admin.hasil')->middleware('admin');
Route::patch('admin/hasil/update', 
    [App\Http\Controllers\AdminController::class, 'update_hasil'])->name('admin.hasil.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataNilaiHasil/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataHasil']);

Route::get('admin/ekskul',
    [App\Http\Controllers\AdminController::class, 'ekskul'])->name('admin.ekskul')->middleware('admin');
Route::post('admin/ekskul', 
    [App\Http\Controllers\AdminController::class, 'submit_ekskul'])->name('admin.ekskul.submit')->middleware('admin');
Route::patch('admin/ekskul/update', 
    [App\Http\Controllers\AdminController::class, 'update_ekskul'])->name('admin.ekskul.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataEkskul/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataEkskul']);
Route::post('admin/ekskul/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_ekskul'])->name('admin.ekskul.delete')->middleware('admin');

Route::get('admin/riwayat_ekskul/{id}',
    [App\Http\Controllers\AdminController::class, 'riwayat_ekskul'])->name('admin.riwayat.ekskul')->middleware('admin');
Route::post('admin/riwayat_ekskul', 
    [App\Http\Controllers\AdminController::class, 'submit_riwayat_ekskul'])->name('admin.riwayat.ekskul.submit')->middleware('admin');
Route::patch('admin/riwayat_ekskul/update', 
    [App\Http\Controllers\AdminController::class, 'update_riwayat_ekskul'])->name('admin.riwayat.ekskul.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataRiwayat/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataRiwayatEkskul']);
Route::post('admin/riwayat_ekskul/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_riwayat_ekskul'])->name('admin.riwayat.ekskul.delete')->middleware('admin');

Route::get('admin/laporan',
    [App\Http\Controllers\AdminController::class, 'laporan'])->name('admin.laporan')->middleware('admin');
Route::get('admin/print/{id}',
    [App\Http\Controllers\AdminController::class, 'print'])->name('admin.laporan.print')->middleware('admin');
Route::get('admin/laporan/{id}',
    [App\Http\Controllers\AdminController::class, 'pilih_kurikulum'])->name('admin.pilih.kurikulum')->middleware('admin');
Route::get('admin/laporan/cetak/{NISN}/{id}',
    [App\Http\Controllers\AdminController::class, 'cetak'])->name('admin.cetak')->middleware('admin');

Route::get('admin/data_user',
    [App\Http\Controllers\AdminController::class, 'data_user'])->name('admin.pengguna')->middleware('admin');
Route::post('admin/data_user', 
    [App\Http\Controllers\AdminController::class, 'submit_user'])->name('admin.pengguna.submit')->middleware('admin');
Route::patch('admin/data_user/update', 
    [App\Http\Controllers\AdminController::class, 'update_user'])->name('admin.pengguna.update')->middleware('admin');
Route::post('admin/data_user/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_user'])->name('admin.pengguna.delete')->middleware('admin');
Route::get('admin/ajaxadmin/dataUser/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataUser']);

Route::get('admin/RTindakan',
    [App\Http\Controllers\AdminController::class, 'RTindakan'])->name('admin.RTindakan')->middleware('admin');
Route::post('admin/RTindakan', 
    [App\Http\Controllers\AdminController::class, 'submit_RTindakan'])->name('admin.RTindakan.submit')->middleware('admin');
Route::patch('admin/RTindakan/update', 
    [App\Http\Controllers\AdminController::class, 'update_RTindakan'])->name('admin.RTindakan.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataRTindakan/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataRTindakan']);
Route::post('admin/RTindakan/delete/{id}',
    [App\Http\Controllers\AdminController::class, 'delete_RTindakan'])->name('admin.RTindakan.delete')->middleware('admin');
Route::get('admin/RTindakan/fetch',
    [App\Http\Controllers\AdminController::class, 'fetch_siswa'])->name('admin.tindakan.fetch');

Route::get('admin/tindakan',
    [App\Http\Controllers\AdminController::class, 'tindakan'])->name('admin.tindakan')->middleware('admin');
Route::patch('admin/tindakan/update', 
    [App\Http\Controllers\AdminController::class, 'update_tindakan'])->name('admin.tindakan.update')->middleware('admin');
Route::get('admin/ajaxadmin/dataTindakan/{id}', 
    [App\Http\Controllers\AdminController::class, 'getDataTindakan']);

Auth::routes();
Route::get('TU/home',
    [App\Http\Controllers\BendaharaController::class, 'index'])->name('TU.home')->middleware('TU');
Route::get('TU/tambah_pendaftar',
    [App\Http\Controllers\BendaharaController::class, 'view_input'])->name('TU.pendaftaran.tambah')->middleware('TU');
Route::get('TU/{id}/edit_pendaftar',
    [App\Http\Controllers\BendaharaController::class, 'view_edit'])->name('TU.pendaftaran.edit')->middleware('TU');
Route::patch('TU/update_pendaftar',
     [App\Http\Controllers\BendaharaController::class, 'update_pendaftar'])->name('TU.pendaftaran.update')->middleware('TU');
Route::get('TU/pendaftar',
    [App\Http\Controllers\BendaharaController::class, 'view_pendaftar'])->name('TU.pendaftaran')->middleware('TU');
Route::get('TU/orangtua',
    [App\Http\Controllers\BendaharaController::class, 'view_orangtua'])->name('TU.pendaftaran.orangtua')->middleware('TU');
Route::get('TU/sekolah',
    [App\Http\Controllers\BendaharaController::class, 'view_sekolah'])->name('TU.pendaftaran.sekolah')->middleware('TU');
Route::get('TU/ajaxadmin/dataPendaftar/{id}', 
    [App\Http\Controllers\BendaharaController::class, 'getDatapendaftar']);
Route::post('TU/tambah_pendaftar', 
    [App\Http\Controllers\BendaharaController::class, 'submit_pendaftar'])->name('TU.pendaftaran.submit')->middleware('TU');
Route::post('TU/pendaftar/delete/{id}', 
    [App\Http\Controllers\BendaharaController::class, 'delete_pendaftar'])->name('TU.pendaftaran.delete')->middleware('TU');

Route::get('TU/penerimaan',
    [App\Http\Controllers\BendaharaController::class, 'penerimaan'])->name('TU.penerimaan')->middleware('TU');
Route::get('TU/penerimaan/terima/{id}',
    [App\Http\Controllers\BendaharaController::class, 'terima'])->name('TU.penerimaan.terima')->middleware('TU');
Route::get('TU/penerimaan/tolak/{id}',
    [App\Http\Controllers\BendaharaController::class, 'tolak'])->name('TU.penerimaan.tolak')->middleware('TU');

Route::get('TU/data_siswa',
    [App\Http\Controllers\BendaharaController::class, 'data_siswa'])->name('TU.siswa')->middleware('TU');
Route::post('TU/data_siswa', 
    [App\Http\Controllers\BendaharaController::class, 'submit_siswa'])->name('TU.siswa.submit')->middleware('TU');
Route::patch('TU/data_siswa/update', 
    [App\Http\Controllers\BendaharaController::class, 'update_siswa'])->name('TU.siswa.update')->middleware('TU');
Route::get('TU/ajaxadmin/dataSiswa/{id}', 
    [App\Http\Controllers\BendaharaController::class, 'getDataSiswa']);
Route::post('TU/data_siswa/delete/{id}',
    [App\Http\Controllers\BendaharaController::class, 'delete_siswa'])->name('TU.siswa.delete')->middleware('TU');

Route::get('TU/data_guru',
    [App\Http\Controllers\BendaharaController::class, 'data_guru'])->name('TU.guru')->middleware('TU');
Route::post('TU/data_guru', 
    [App\Http\Controllers\BendaharaController::class, 'submit_guru'])->name('TU.guru.submit')->middleware('TU');
Route::patch('TU/data_guru/update', 
    [App\Http\Controllers\BendaharaController::class, 'update_guru'])->name('TU.guru.update')->middleware('TU');
Route::post('TU/data_guru/delete/{id}',
    [App\Http\Controllers\BendaharaController::class, 'delete_guru'])->name('TU.guru.delete')->middleware('TU');
Route::get('TU/ajaxadmin/dataGuru/{id}', 
    [App\Http\Controllers\BendaharaController::class, 'getDataGuru']);


Route::get('TU/administrasi',
    [App\Http\Controllers\BendaharaController::class, 'administrasi'])->name('TU.administrasi')->middleware('TU');
Route::post('TU/administrasi', 
    [App\Http\Controllers\BendaharaController::class, 'submit_administrasi'])->name('TU.administrasi.submit')->middleware('TU');
Route::patch('TU/administrasi/update', 
    [App\Http\Controllers\BendaharaController::class, 'update_administrasi'])->name('TU.administrasi.update')->middleware('TU');
Route::get('TU/ajaxadmin/dataAdministrasi/{id}', 
    [App\Http\Controllers\BendaharaController::class, 'getDataAdministrasi']);
Route::post('TU/administrasi/delete/{id}',
    [App\Http\Controllers\BendaharaController::class, 'delete_administrasi'])->name('TU.administrasi.delete')->middleware('TU');

Route::get('TU/administrasi_siswa',
    [App\Http\Controllers\BendaharaController::class, 'administrasi_siswa'])->name('TU.administrasi.siswa')->middleware('TU');
Route::get('TU/administrasi_siswa/{NISN}/{id}',
    [App\Http\Controllers\BendaharaController::class, 'pembayaran'])->name('TU.administrasi.pembayaran')->middleware('TU');
Route::post('TU/administrasi_siswa/pembayaran', 
    [App\Http\Controllers\BendaharaController::class, 'submit_bayar'])->name('TU.bayar.submit')->middleware('TU');
Route::post('TU/administrasi', 
    [App\Http\Controllers\BendaharaController::class, 'laporan_administrasi'])->name('TU.administrasi.laporan')->middleware('TU');



Auth::routes();
Route::get('siswa/home',
    [App\Http\Controllers\SiswaController::class, 'index'])->name('siswa.home')->middleware('siswa');
Route::get('siswa/jadwal',
    [App\Http\Controllers\SiswaController::class, 'jadwal'])->name('siswa.jadwal')->middleware('siswa');
Route::get('siswa/nilai',
    [App\Http\Controllers\SiswaController::class, 'pilih_kurikulum'])->name('siswa.nilai')->middleware('siswa');
Route::get('siswa/nilai/cetak/{id}',
    [App\Http\Controllers\SiswaController::class, 'cetak'])->name('siswa.cetak')->middleware('siswa');
Route::get('siswa/administrasi',
    [App\Http\Controllers\SiswaController::class, 'pembayaran'])->name('siswa.administrasi')->middleware('siswa');

Auth::routes();
Route::get('walikelas/home',
    [App\Http\Controllers\WalikelasController::class, 'index'])->name('walikelas.home')->middleware('walikelas');
Route::get('walikelas/jadwal',
    [App\Http\Controllers\WalikelasController::class, 'jadwal'])->name('walikelas.jadwal')->middleware('walikelas');

Route::get('walikelas/ekskul',
    [App\Http\Controllers\WalikelasController::class, 'ekskul'])->name('walikelas.ekskul')->middleware('walikelas');
Route::get('walikelas/riwayat_ekskul/{id}',
    [App\Http\Controllers\WalikelasController::class, 'riwayat_ekskul'])->name('walikelas.riwayat.ekskul')->middleware('walikelas');
Route::post('walikelas/riwayat_ekskul', 
    [App\Http\Controllers\WalikelasController::class, 'submit_riwayat_ekskul'])->name('walikelas.riwayat.ekskul.submit')->middleware('walikelas');
Route::patch('walikelas/riwayat_ekskul/update', 
    [App\Http\Controllers\WalikelasController::class, 'update_riwayat_ekskul'])->name('walikelas.riwayat.ekskul.update')->middleware('walikelas');
Route::get('walikelas/ajaxadmin/dataRiwayat/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'getDataRiwayatEkskul']);
Route::post('walikelas/riwayat_ekskul/delete/{id}',
    [App\Http\Controllers\WalikelasController::class, 'delete_riwayat_ekskul'])->name('walikelas.riwayat.ekskul.delete')->middleware('walikelas');
    
Route::get('walikelas/pengampu',
    [App\Http\Controllers\WalikelasController::class, 'pengampu'])->name('walikelas.pengampu')->middleware('walikelas');
Route::get('walikelas/penilaian/{id}',
    [App\Http\Controllers\WalikelasController::class, 'penilaian'])->name('walikelas.penilaian')->middleware('walikelas');
Route::post('walikelas/penilaian', 
    [App\Http\Controllers\WalikelasController::class, 'submit_penilaian'])->name('walikelas.penilaian.submit')->middleware('walikelas');
Route::patch('walikelas/penilaian/update', 
    [App\Http\Controllers\WalikelasController::class, 'update_penilaian'])->name('walikelas.penilaian.update')->middleware('walikelas');
Route::get('walikelas/ajaxadmin/dataPenilaian/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'getDataPenilaian']);
Route::post('walikelas/penilaian/delete/{id}',
    [App\Http\Controllers\WalikelasController::class, 'delete_penilaian'])->name('walikelas.penilaian.delete')->middleware('walikelas');
Route::get('walikelas/penilaian/riwayat/{id}',
    [App\Http\Controllers\WalikelasController::class, 'riwayat_penilaian'])->name('walikelas.riwayat.penilaian')->middleware('walikelas');
Route::patch('walikelas/penilaian/riwayat', 
    [App\Http\Controllers\WalikelasController::class, 'update_riwayat'])->name('walikelas.riwayat.update')->middleware('walikelas');
Route::get('walikelas/hasil/{id}',
    [App\Http\Controllers\WalikelasController::class, 'hasil'])->name('walikelas.hasil')->middleware('walikelas');
Route::patch('walikelas/hasil/update', 
    [App\Http\Controllers\WalikelasController::class, 'update_hasil'])->name('walikelas.hasil.update')->middleware('walikelas');
Route::get('walikelas/ajaxadmin/dataNilaiHasil/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'getDataHasil']);

Route::get('walikelas/administrasi',
    [App\Http\Controllers\WalikelasController::class, 'administrasi'])->name('walikelas.RTindakan')->middleware('walikelas');
Route::get('walikelas/administrasi/{NISN}/{id}',
    [App\Http\Controllers\WalikelasController::class, 'pembayaran'])->name('walikelas.administrasi')->middleware('walikelas');

Route::get('walikelas/RTindakan',
    [App\Http\Controllers\WalikelasController::class, 'RTindakan'])->name('walikelas.RTindakan')->middleware('walikelas');
Route::post('walikelas/RTindakan', 
    [App\Http\Controllers\WalikelasController::class, 'submit_RTindakan'])->name('walikelas.RTindakan.submit')->middleware('walikelas');
Route::patch('walikelas/RTindakan/update', 
    [App\Http\Controllers\WalikelasController::class, 'update_RTindakan'])->name('walikelas.RTindakan.update')->middleware('walikelas');
Route::get('walikelas/ajaxadmin/dataRTindakan/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'getDataRTindakan']);
Route::post('walikelas/RTindakan/delete/{id}',
    [App\Http\Controllers\WalikelasController::class, 'delete_RTindakan'])->name('walikelas.RTindakan.delete')->middleware('walikelas');
Route::get('walikelas/RTindakan/fetch',
    [App\Http\Controllers\WalikelasController::class, 'fetch_siswa'])->name('walikelas.tindakan.fetch');

Route::get('walikelas/tindakan',
    [App\Http\Controllers\WalikelasController::class, 'tindakan'])->name('walikelas.tindakan')->middleware('walikelas');
Route::get('walikelas/tindakan/{id}', 
    [App\Http\Controllers\WalikelasController::class, 'tindak'])->name('walikelas.tindakan.update')->middleware('walikelas');

Route::get('walikelas/laporan',
    [App\Http\Controllers\WalikelasController::class, 'laporan'])->name('walikelas.laporan')->middleware('walikelas');
Route::get('walikelas/print/{id}',
    [App\Http\Controllers\WalikelasController::class, 'print'])->name('walikelas.laporan.print')->middleware('walikelas');
Route::get('walikelas/laporan/{id}',
    [App\Http\Controllers\WalikelasController::class, 'pilih_kurikulum'])->name('walikelas.pilih.kurikulum')->middleware('walikelas');
Route::get('walikelas/laporan/cetak/{NISN}/{id}',
    [App\Http\Controllers\WalikelasController::class, 'cetak'])->name('walikelas.cetak')->middleware('walikelas');
    
Auth::routes();
Route::get('guru/home',
    [App\Http\Controllers\GuruController::class, 'index'])->name('guru.home')->middleware('guru');
Route::get('guru/jadwal',
    [App\Http\Controllers\GuruController::class, 'jadwal'])->name('guru.jadwal')->middleware('guru');

Route::get('guru/ekskul',
    [App\Http\Controllers\GuruController::class, 'ekskul'])->name('guru.ekskul')->middleware('guru');
Route::get('guru/riwayat_ekskul/{id}',
    [App\Http\Controllers\GuruController::class, 'riwayat_ekskul'])->name('guru.riwayat.ekskul')->middleware('guru');
Route::post('guru/riwayat_ekskul', 
    [App\Http\Controllers\GuruController::class, 'submit_riwayat_ekskul'])->name('guru.riwayat.ekskul.submit')->middleware('guru');
Route::patch('guru/riwayat_ekskul/update', 
    [App\Http\Controllers\GuruController::class, 'update_riwayat_ekskul'])->name('guru.riwayat.ekskul.update')->middleware('guru');
Route::get('guru/ajaxadmin/dataRiwayat/{id}', 
    [App\Http\Controllers\GuruController::class, 'getDataRiwayatEkskul']);
Route::post('guru/riwayat_ekskul/delete/{id}',
    [App\Http\Controllers\GuruController::class, 'delete_riwayat_ekskul'])->name('guru.riwayat.ekskul.delete')->middleware('guru');

Route::get('guru/pengampu',
    [App\Http\Controllers\GuruController::class, 'pengampu'])->name('guru.pengampu')->middleware('guru');
Route::get('guru/penilaian/{id}',
    [App\Http\Controllers\GuruController::class, 'penilaian'])->name('guru.penilaian')->middleware('guru');
Route::post('guru/penilaian', 
    [App\Http\Controllers\GuruController::class, 'submit_penilaian'])->name('guru.penilaian.submit')->middleware('guru');
Route::patch('guru/penilaian/update', 
    [App\Http\Controllers\GuruController::class, 'update_penilaian'])->name('guru.penilaian.update')->middleware('guru');
Route::get('guru/ajaxadmin/dataPenilaian/{id}', 
    [App\Http\Controllers\GuruController::class, 'getDataPenilaian']);
Route::post('guru/penilaian/delete/{id}',
    [App\Http\Controllers\GuruController::class, 'delete_penilaian'])->name('guru.penilaian.delete')->middleware('guru');
Route::get('guru/penilaian/riwayat/{id}',
    [App\Http\Controllers\GuruController::class, 'riwayat_penilaian'])->name('guru.riwayat.penilaian')->middleware('guru');

Route::get('guru/hasil/{id}',
    [App\Http\Controllers\GuruController::class, 'hasil'])->name('guru.hasil')->middleware('guru');
Route::patch('guru/hasil/update', 
    [App\Http\Controllers\GuruController::class, 'update_hasil'])->name('guru.hasil.update')->middleware('guru');
Route::get('guru/ajaxadmin/dataNilaiHasil/{id}', 
    [App\Http\Controllers\GuruController::class, 'getDataHasil']);

Route::get('guru/RTindakan',
    [App\Http\Controllers\GuruController::class, 'RTindakan'])->name('guru.RTindakan')->middleware('guru');
Route::post('guru/RTindakan', 
    [App\Http\Controllers\GuruController::class, 'submit_RTindakan'])->name('guru.RTindakan.submit')->middleware('guru');
Route::patch('guru/RTindakan/update', 
    [App\Http\Controllers\GuruController::class, 'update_RTindakan'])->name('guru.RTindakan.update')->middleware('guru');
Route::get('guru/ajaxadmin/dataRTindakan/{id}', 
    [App\Http\Controllers\GuruController::class, 'getDataRTindakan']);
Route::post('guru/RTindakan/delete/{id}',
    [App\Http\Controllers\GuruController::class, 'delete_RTindakan'])->name('guru.RTindakan.delete')->middleware('guru');
Route::get('guru/RTindakan/fetch',
    [App\Http\Controllers\GuruController::class, 'fetch_siswa'])->name('guru.tindakan.fetch');


Auth::routes();
Route::get('kepala/home',
    [App\Http\Controllers\KepsekController::class, 'index'])->name('kepala.home')->middleware('kepala');
Route::get('kepala/jadwal',
    [App\Http\Controllers\KepsekController::class, 'jadwal'])->name('kepala.jadwal')->middleware('kepala');

Route::get('kepala/pengampu',
    [App\Http\Controllers\KepsekController::class, 'pengampu'])->name('kepala.pengampu')->middleware('kepala');
Route::get('kepala/penilaian/{id}',
    [App\Http\Controllers\KepsekController::class, 'penilaian'])->name('kepala.penilaian')->middleware('kepala');
Route::post('kepala/penilaian', 
    [App\Http\Controllers\KepsekController::class, 'submit_penilaian'])->name('kepala.penilaian.submit')->middleware('kepala');
Route::patch('kepala/penilaian/update', 
    [App\Http\Controllers\KepsekController::class, 'update_penilaian'])->name('kepala.penilaian.update')->middleware('kepala');
Route::get('kepala/ajaxadmin/dataPenilaian/{id}', 
    [App\Http\Controllers\KepsekController::class, 'getDataPenilaian']);
Route::post('kepala/penilaian/delete/{id}',
    [App\Http\Controllers\KepsekController::class, 'delete_penilaian'])->name('kepala.penilaian.delete')->middleware('kepala');
Route::get('kepala/penilaian/riwayat/{id}',
    [App\Http\Controllers\KepsekController::class, 'riwayat_penilaian'])->name('kepala.riwayat.penilaian')->middleware('kepala');

Route::get('kepala/hasil/{id}',
    [App\Http\Controllers\KepsekController::class, 'hasil'])->name('kepala.hasil')->middleware('guru');
Route::patch('kepala/hasil/update', 
    [App\Http\Controllers\KepsekController::class, 'update_hasil'])->name('kepala.hasil.update')->middleware('kepala');
Route::get('kepala/ajaxadmin/dataNilaiHasil/{id}', 
    [App\Http\Controllers\KepsekController::class, 'getDataHasil']);

Route::get('kepala/penerimaan',
    [App\Http\Controllers\KepsekController::class, 'penerimaan'])->name('kepala.penerimaan')->middleware('kepala');
Route::post('kepala/penerimaan', 
    [App\Http\Controllers\KepsekController::class, 'laporan_penerimaan'])->name('kepala.penerimaan.laporan')->middleware('kepala');

Route::get('kepala/riwayat_penilaian',
    [App\Http\Controllers\KepsekController::class, 'riwayat_penilaians'])->name('kepala.riwayat.penilaian')->middleware('kepala');
Route::get('kepala/riwayat_penilaian/{id}',
    [App\Http\Controllers\KepsekController::class, 'riwayat_penilaian'])->name('kepala.riwayat')->middleware('kepala');
Route::post('kepala/riwayat_penilaian', 
    [App\Http\Controllers\KepsekController::class, 'laporan_penilaian'])->name('kepala.penilaian.laporan')->middleware('kepala');

Route::get('kepala/administrasi',
    [App\Http\Controllers\KepsekController::class, 'riwayat_administrasi'])->name('kepala.riwayat.administrasi')->middleware('kepala');
Route::post('kepala/administrasi/laporan', 
    [App\Http\Controllers\KepsekController::class, 'laporan_administrasi'])->name('kepala.administrasi.laporan')->middleware('kepala');

Route::get('kepala/RTindakan',
    [App\Http\Controllers\KepsekController::class, 'RTindakan'])->name('kepala.RTindakan')->middleware('kepala');
Route::post('kepala/RTindakan', 
    [App\Http\Controllers\KepsekController::class, 'submit_RTindakan'])->name('kepala.RTindakan.submit')->middleware('kepala');
Route::post('kepala/RTindakan/laporan', 
    [App\Http\Controllers\KepsekController::class, 'submit_RTindakan'])->name('kepala.RTindakan.laporan')->middleware('kepala');
Route::patch('kepala/RTindakan/update', 
    [App\Http\Controllers\KepsekController::class, 'update_RTindakan'])->name('kepala.RTindakan.update')->middleware('kepala');
Route::get('kepala/ajaxadmin/dataRTindakan/{id}', 
    [App\Http\Controllers\KepsekController::class, 'getDataRTindakan']);
Route::post('kepala/RTindakan/delete/{id}',
    [App\Http\Controllers\KepsekController::class, 'delete_RTindakan'])->name('kepala.RTindakan.delete')->middleware('kepala');
Route::get('kepala/RTindakan/fetch',
    [App\Http\Controllers\KepsekController::class, 'fetch_siswa'])->name('kepala.tindakan.fetch');
Route::get('kepala/tindakan',
    [App\Http\Controllers\KepsekController::class, 'tindakan'])->name('kepala.tindakan')->middleware('kepala');
Route::post('kepala/administrasi', 
    [App\Http\Controllers\KepsekController::class, 'laporan_tindakan'])->name('kepala.tindakan.laporan')->middleware('kepala');

    Auth::routes();
    Route::get('pengunjung/home',
        [App\Http\Controllers\PengunjungController::class, 'index'])->name('pengunjung.home')->middleware('pengunjung');
    Route::get('pengunjung/daftar',
        [App\Http\Controllers\PengunjungController::class, 'daftar'])->name('pengunjung.daftar')->middleware('pengunjung');
    Route::post('pengunjung/daftar',
        [App\Http\Controllers\PengunjungController::class, 'daftar_submit'])->name('pengunjung.daftar')->middleware('pengunjung');
    Route::get('pengunjung/info',
        [App\Http\Controllers\PengunjungController::class, 'info'])->name('pengunjung.info')->middleware('pengunjung');