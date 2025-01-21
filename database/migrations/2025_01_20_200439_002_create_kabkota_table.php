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
            $table
                ->bigInteger('provinsi_id')
                ->unsigned()
                ->index();
            $table->bigInteger('populasi')->nullable();
            $table->geometry('geometry')->nullable();
            $table->integer('kodepos')->nullable();
            $table->integer('kecamatan')->nullable();
            $table->integer('desa')->nullable();
            $table->bigInteger('islam')->nullable();
            $table->bigInteger('kristen')->nullable();
            $table->bigInteger('katolik')->nullable();
            $table->bigInteger('hindu')->nullable();
            $table->bigInteger('pk_petani')->nullable();
            $table->bigInteger('pk_nelayan')->nullable();
            $table->bigInteger('pk_pedagang')->nullable();
            $table->bigInteger('pk_asn')->nullable();
            $table->string('nama');
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
