<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengampusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengampus', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->string('NUPTK',20);
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
        Schema::dropIfExists('pengampus');
    }
}
