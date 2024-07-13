<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'NISN','NISN')
                        ->withDefault(['NISN' => 'Role Belum Dipilih']);
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Role Belum Dipilih']);
    }
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id','id')
                        ->withDefault(['kurikulum_id' => 'Role Belum Dipilih']);
    }
}
