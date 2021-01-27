<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDtlAbsensiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dtl_absensi', function (Blueprint $table) {
            $table->bigIncrements('id_absen');
            $table->date('tgl_absen');
            $table->string('materi');
            $table->string('kegiatan');
            $table->string('minggu');
            $table->string('bulan');
            $table->string('jam');
            $table->unsignedBigInteger('mata_pelajaran_id');
            $table->string('tipe', 50);
            $table->unsignedBigInteger('guru_id');
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
        Schema::dropIfExists('dtl_absensi');
    }
}
