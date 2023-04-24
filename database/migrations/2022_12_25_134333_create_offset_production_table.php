<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffsetProductionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offset_production', function (Blueprint $table) {
            $table->unsignedBigInteger('offset_id');
            $table->unsignedBigInteger('production_id');

            $table->foreign('offset_id')->references('id')->on('offsets')->onDelete('restrict');
            $table->foreign('production_id')->references('id')->on('productions')->onDelete('restrict');
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offset_production');
    }
}