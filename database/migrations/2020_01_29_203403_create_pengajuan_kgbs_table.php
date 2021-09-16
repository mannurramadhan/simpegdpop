<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanKgbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_kgbs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pegawais_nip')->notNull();
            $table->integer('gaji_lama');
            $table->integer('gaji_baru');
            $table->string('pejabat_lama');
            $table->string('pejabat_baru');
            $table->string('no_sk_lama');
            $table->string('no_sk_baru');
            $table->date('tanggal_sk_lama');
            $table->date('tanggal_sk_baru');
            $table->date('tmt_lama');
            $table->date('tmt_baru');
            $table->integer('mkg_lama');
            $table->integer('mkg_baru');
            $table->string('tanggal_kgb_baru');
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
        Schema::dropIfExists('pengajuan_kgbs');
    }
}
