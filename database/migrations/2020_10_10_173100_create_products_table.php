<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function product_demo()
    {
        Schema::create('products_demo', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string("price");
            $table->string("category");
            $table->integer('product_catagory')->unsigned;
            $table->foreign('product_catagory')->references('id')->on('product_catagory');
            $table->string("description");
            $table->string("gallery");
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
        Schema::dropIfExists('products');
    }
}
