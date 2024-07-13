<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tahun_akademik_id')->constrained();
            $table->foreignId('kelas_id')->constrained();
            $table->foreignId('mapel_id')->constrained();
            $table->foreignId('guru_id')->constrained();
            $table->foreignId('kurikulum_id')->constrained();
            $table->string('jam',25);
            $table->string('hari',10);
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
        Schema::dropIfExists('jadwals');
    }
}
