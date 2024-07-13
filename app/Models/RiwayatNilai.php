<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatNilai extends Model
{
    use HasFactory;
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'Kurikulum Belum Dipilih']);
    }
}
