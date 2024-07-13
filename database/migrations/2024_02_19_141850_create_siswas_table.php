<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('NISN',15)->unique();
            $table->string('nama_lengkap',50);
            $table->string('gender',6);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir',30);
            $table->string('agama',25);
            $table->foreignId('kelas_id')->constrained();
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
        Schema::dropIfExists('siswas');
    }
}
