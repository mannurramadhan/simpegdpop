<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKearsipanPegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kearsipan_pegawais', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('pegawais_nip')->notNull()->unique();
            $table->date('tahun_pensiun_mutasi');
            $table->timestamps();

            $table->foreign('pegawais_nip')
                    ->references('nip')
                    ->on('pegawais')
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
        Schema::dropIfExists('kearsipan_pegawais');
    }
}
