<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->string('nip')->primary()->notNull();
            $table->string('nik')->unique();
            $table->string('nama');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->integer('usia')->unsigned();
            $table->string('jenis_kelamin');
            $table->string('pendidikan_terakhir');
            $table->string('jabatan');
            $table->string('eselon');
            $table->string('status_kepegawaian');
            $table->string('golongan');
            $table->integer('mkg')->unsigned();
            $table->integer('gajis_id')->unsigned();
            $table->integer('gaji_pegawai')->unsigned();
            $table->integer('sisa_tahun_n')->unsigned();
            $table->integer('sisa_tahun_n1')->unsigned();
            $table->integer('sisa_tahun_n2')->unsigned();
            $table->date('tahun_masuk_kerja');
            $table->date('tahun_terakhir_kgb');
            $table->date('tahun_terakhir_pangkat');
            $table->date('tahun_pensiun');
            $table->string('update_kgb');
            $table->string('update_pangkat');
            $table->string('update_pensiun');
            $table->integer('durasi_pensiun');
            $table->timestamps();

            $table->foreign('gajis_id')
                    ->references('id')
                    ->on('gajis')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pegawais');
    }
}
