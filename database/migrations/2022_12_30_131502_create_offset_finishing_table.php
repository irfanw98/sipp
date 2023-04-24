<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffsetFinishingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offset_finishing', function (Blueprint $table) {
            $table->unsignedBigInteger('offset_id');
            $table->unsignedBigInteger('finishing_id');

            $table->foreign('offset_id')->references('id')->on('offsets')->onDelete('cascade');
            $table->foreign('finishing_id')->references('id')->on('finishings')->onDelete('cascade');
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
        Schema::dropIfExists('offset_finishing');
    }
}