<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengampu extends Model
{
    use HasFactory;
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'NUPTK','NUPTK')
                        ->withDefault(['NUPTK' => 'Jurusan Belum Dipilih']);
    }
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id','id')
                        ->withDefault(['mapel_id' => 'Jurusan Belum Dipilih']);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Jurusan Belum Dipilih']);
    }
}
