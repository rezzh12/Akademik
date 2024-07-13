<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRiwayatAdministrasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('riwayat_administrasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode',10);
            $table->date('tanggal');
            $table->string('bulan',20);
            $table->integer('jumlah');
            $table->string('foto',100);
            $table->string('keterangan',50);
            $table->string('NISN',15);
            $table->foreignId('administrasi_siswa_id')->constrained();
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
        Schema::dropIfExists('riwayat_administrasis');
    }
}
