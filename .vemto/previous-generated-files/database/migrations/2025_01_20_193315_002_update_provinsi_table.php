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
        Schema::table('provinsi', function (Blueprint $table) {
            $table
                ->bigInteger('kabkota_id')
                ->unsigned()
                ->after('geometry');
            $table
                ->foreign('kabkota_id')
                ->references('id')
                ->on('kabkota')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->dropColumn('kabkota_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('provinsi', function (Blueprint $table) {
            $table->dropColumn('kabkota_id');
            $table->dropForeign('provinsi_kabkota_id_foreign');
            $table
                ->bigInteger('kabkota_id')
                ->unsigned()
                ->index()
                ->after('geometry');
        });
    }
};
