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
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('barcode')->nullable();
            $table->unsignedBigInteger('brand');
            $table->unsignedBigInteger('category');
            $table->integer('hsn_code')->default(0);
            $table->float('cost_price');
            $table->float('price');
            $table->enum("type",array("product","service"))->default("product");
            $table->float('gst')->default(0);
            $table->integer('stock')->default(0); //change to float for kg kind of stock
            $table->foreign('brand')->references('id')->on('brands');
            $table->foreign('category')->references('id')->on('categories');
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
