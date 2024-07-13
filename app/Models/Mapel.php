<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    use HasFactory;
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class, 'kurikulum_id','id')
                        ->withDefault(['kurikulum_id' => 'Kurikulum Belum Dipilih']);
    }
}
