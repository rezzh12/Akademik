<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->string('NISN',20);
            $table->string('kategori',20);
            $table->string('keterangan',20)->nullable();
            $table->integer('skor')->nullable();
            $table->foreignId('penilaian_id')->constrained();
            $table->foreignId('pengampu_id')->constrained();
            $table->foreignId('mapel_id')->constrained();
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('kurikulum_id')->constrained();
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
        Schema::dropIfExists('riwayat_nilais');
    }
}
