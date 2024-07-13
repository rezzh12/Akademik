<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory; 
    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id','id')
                        ->withDefault(['mapel_id' => 'Kurikulum Belum Dipilih']);
    }
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id','id')
                        ->withDefault(['guru_id' => 'Kurikulum Belum Dipilih']);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Kurikulum Belum Dipilih']);
    }
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id','id')
                        ->withDefault(['kurikulum_id' => 'Kurikulum Belum Dipilih']);
    }

}
