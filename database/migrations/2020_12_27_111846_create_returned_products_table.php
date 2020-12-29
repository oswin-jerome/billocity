<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReturnedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('returned_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product');
            $table->unsignedBigInteger('invoice');
            $table->unsignedBigInteger('customer')->nullable();
            $table->float('product_price');
            $table->float('sold_price');
            $table->integer('quantity'); //change to float if necessary
            $table->timestamps();


            $table->foreign('product')->references('id')->on('products');
            $table->foreign('invoice')->references('id')->on('invoices');
            $table->foreign('customer')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('returned_products');
    }
}
