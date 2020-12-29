<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->float('total');
            $table->string('coupon')->nullable();
            $table->float('final_price');
            $table->unsignedBigInteger('customer')->nullable();
            $table->enum('status', array('CANCLED', 'PAUSED','COMPLETED'));
            $table->enum('payment_method', array('CASH', 'CARD','CREDIT'));
            $table->float('paid_amount');
            $table->float('points_redeem')->default(0);
            $table->float('coupon_redeem')->default(0);
            $table->timestamps();
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
        Schema::dropIfExists('invoices');
    }
}
