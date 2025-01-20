<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('provinsis', function (Blueprint $table) {
        $table->id();
        $table->string('name')->nullable(false);
        $table->string('alt_name')->default('');
        $table->geometry('boundary');
        $table->double('latitude')->default(0)->nullable(false);
        $table->double('longitude')->default(0)->nullable(false);
        $table->bigInteger('population')->default(0)->nullable();
        $table->decimal('luas')->nullable();
        $table->decimal('gdp', 15, 2)->nullable();
        $table->enum('type_polygon', ['Polygon', 'MultiPolygon'])->default('Polygon');
        $table->LongText('polygon')->nullable(true);
        $table->float('penduduk_miskin')->nullable();
        $table->integer('usia_produktif')->nullable();
        $table->integer('pengangguran')->nullable();
        $table->integer('buta_aksara')->nullable();
        $table->integer('pendidikan_s1')->nullable();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinsis');
    }
};
