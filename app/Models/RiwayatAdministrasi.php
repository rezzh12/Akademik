<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatAdministrasi extends Model
{
    use HasFactory;
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'Kurikulum Belum Dipilih']);
    } 
    public function administrasi()
    {
        return $this->belongsTo(AdministrasiSiswa::class, 'administrasi_siswa_id','id')
                        ->withDefault(['administrasi_siswa_id' => 'Kurikulum Belum Dipilih']);
    } 
}
