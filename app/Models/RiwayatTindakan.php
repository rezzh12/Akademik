<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatTindakan extends Model
{
    use HasFactory;
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'Kurikulum Belum Dipilih']);
    } 
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'NUPTK','NUPTK')
                        ->withDefault(['NUPTK' => 'Kurikulum Belum Dipilih']);
    }
}
