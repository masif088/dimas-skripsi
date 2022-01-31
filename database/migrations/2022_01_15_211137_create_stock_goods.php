<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockGoods extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_goods', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('supplier_id');
            $table->integer('amount');
            $table->integer('note');
            $table->timestamps();
            $table->foreign('supplier_id')
                ->references('id')
                ->on('suppliers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_goods');
    }
}
