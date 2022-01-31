<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('product_type_id');
            $table->unsignedBigInteger('product_company_id');
            $table->integer('price');
            $table->string('thumbnail')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();

            $table->foreign('product_type_id')
                ->references('id')
                ->on('product_types')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('product_company_id')
                ->references('id')
                ->on('product_companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
