<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TindakanKelas extends Model
{
    use HasFactory;
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'Kurikulum Belum Dipilih']);
    } 
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Kurikulum Belum Dipilih']);
    } 
}
