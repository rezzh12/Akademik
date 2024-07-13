<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->date('tanggal');
            $table->string('NISN',20);
            $table->integer('nilai')->nullable();
            $table->string('ketercapaian',20)->nullable();
            $table->string('deskripsi',100)->nullable();
            $table->integer('Sakit');
            $table->integer('Izin');
            $table->integer('Alfa');
            $table->foreignId('kurikulum_id')->constrained();
            $table->foreignId('mapel_id')->constrained();
            $table->foreignId('kelas_id')->constrained();
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
        Schema::dropIfExists('nilais');
    }
}
