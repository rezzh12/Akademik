<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaiEkskulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nilai_ekskuls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ekskuls_id')->constrained();
            $table->string('NISN',15);
            $table->string('deskripsi',255)->nullable();
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
        Schema::dropIfExists('nilai_ekskuls');
    }
}
