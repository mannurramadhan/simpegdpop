<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kpps', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('pegawais_nip')->notNull();
            $table->string('golongan_baru');
            $table->date('tmt');
            $table->integer('gaji_pokok_baru');
            $table->string('pejabat');
            $table->string('no_sk');
            $table->date('tanggal_sk');
            $table->integer('mkg_baru');
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
        Schema::dropIfExists('pengajuan_kpps');
    }
}
