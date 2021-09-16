<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKgbsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kgbs', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('pegawais_nip')->notNull()->unique();
            $table->string('kenaikan_gaji');
            $table->integer('durasi_kgb');
            $table->string('status');

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
        Schema::dropIfExists('kgbs');
    }
}
