<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatTindakansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_tindakans', function (Blueprint $table) {
            $table->id();
            $table->string('NUPTK',20);
            $table->string('NISN',15);
            $table->string('judul',50);
            $table->string('kategori',15);
            $table->integer('skor');
            $table->string('foto',100);
            $table->string('deskripsi',255);
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('riwayat_tindakans');
    }
}
