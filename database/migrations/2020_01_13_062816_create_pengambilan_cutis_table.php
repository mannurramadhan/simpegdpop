<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengambilanCutisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengambilan_cutis', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('nip');
            $table->string('nama');
            $table->string('tahun_cuti');
            $table->string('tahun_sisa_cuti');
            $table->date('tanggal_mulai_cuti');
            $table->date('tanggal_akhir_cuti');
            $table->integer('lama_cuti');
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
        Schema::dropIfExists('pengambilan_cutis');
    }
}
