<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForecasts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forecasts', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->float('amount',16,6)->nullable();
            $table->float('level',16,6)->nullable();
            $table->float('trend',16,6)->nullable();
            $table->float('seasonal',16,6)->nullable();
            $table->float('forecast',16,6)->nullable();
            $table->float('error',16,6)->nullable();
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
        Schema::dropIfExists('forecasts');
    }
}
