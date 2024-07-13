<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $fillable =['NISN','nama_lengkap','gender','tanggal_lahir','tempat_lahir','agama','kelas_id'];
    use HasFactory;
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id','id')
                        ->withDefault(['kelas_id' => 'Role Belum Dipilih']);
    }
}
