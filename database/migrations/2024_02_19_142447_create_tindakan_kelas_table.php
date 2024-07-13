<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTindakanKelasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tindakan_kelas', function (Blueprint $table) {
            $table->id();
            $table->string('NUPTK',20);
            $table->string('NISN',15);
            $table->integer('skor');
            $table->string('tindakan',30);
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
        Schema::dropIfExists('tindakan_kelas');
    }
}
