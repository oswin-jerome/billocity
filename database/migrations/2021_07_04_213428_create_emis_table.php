<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("invoice_id")->nullable();
            $table->unsignedBigInteger("customer_id");
            $table->double("amount");
            $table->double("down_payment");
            $table->double("interest_rate");
            $table->enum("interval",array("weekly", "monthly", "daily"))->default("monthly");
            $table->integer("period");
            $table->date("start_date");
            $table->timestamps();
            $table->foreign("invoice_id")->references("id")->on("invoices");
            $table->foreign("customer_id")->references("id")->on("customers");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emis');
    }
}


