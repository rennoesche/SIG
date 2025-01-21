<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kabkota', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jml_penduduk')->nullable();
            $table->geometry('geometry')->nullable();
            $table->integer('kodepos')->nullable();
            $table->integer('jml_kecamatan')->nullable();
            $table->integer('jml_desa')->nullable();
            $table->bigInteger('islam')->nullable();
            $table->bigInteger('protestan')->nullable();
            $table->bigInteger('katholik')->nullable();
            $table->bigInteger('hindu')->nullable();
            $table->bigInteger('pk_petani')->nullable();
            $table->bigInteger('pk_nelayan')->nullable();
            $table->bigInteger('pk_pedagang')->nullable();
            $table->bigInteger('pk_asn_tni_polri')->nullable();
            $table->bigInteger('provinsi_id')->unique();
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table
                ->foreign('provinsi_id')
                ->references('id')
                ->on('provinsi')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kabkota');
    }
};
