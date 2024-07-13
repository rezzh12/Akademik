<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePendaftaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->char('NISN',25);
            $table->string('nama',100);
            $table->string('jenis_kelamin',25);
            $table->string('agama',25);
            $table->string('tempat_lahir',25);
            $table->string('tanggal_lahir',25);
            $table->string('alamat',255);
            $table->string('kk',25);
            $table->string('nama_ayah',100);
            $table->string('pekerjaan_ayah',100);
            $table->string('nama_ibu',100);
            $table->string('pekerjaan_ibu',100);
            $table->foreignId('jurusan_id')->constrained();
            $table->string('asal_sekolah',25);
            $table->string('alamat_sekolah',255);
            $table->string('nilai_raport',255);
            $table->string('ijazah',255);
            $table->string('prestasi',255)->nullable();
            $table->boolean('status_pendaftaran');
            $table->date('tgl_pendaftaran');
            $table->string('email',100);
            $table->string('no_hp',55);
            $table->string('no_hp_ortu',55);
            $table->string('pas_foto',255);
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
        Schema::dropIfExists('pendaftarans');
    }
}
