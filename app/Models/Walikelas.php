<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Walikelas extends Model
{
    use HasFactory;
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'NUPTK','NUPTK')
                        ->withDefault(['NUPTK' => 'Kurikulum Belum Dipilih']);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Kurikulum Belum Dipilih']);
    }
    public function akademik()
    {
        return $this->belongsTo(TahunAkademik::class, 'tahun_akademik_id','id')
                        ->withDefault(['tahun_akademik_id' => 'Kurikulum Belum Dipilih']);
    }
}
