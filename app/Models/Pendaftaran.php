<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class, 'jurusan_id','id')
                        ->withDefault(['id' => 'Kurikulum Belum Dipilih']);
    }
}
