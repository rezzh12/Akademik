<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->id();
            $table->string('kode',10);
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->date('tanggal');
            $table->string('judul',50);
            $table->string('kategori',20);
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
        Schema::dropIfExists('penilaians');
    }
}
