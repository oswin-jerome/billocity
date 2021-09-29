<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmiEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emi_entries', function (Blueprint $table) {
            $table->id();
            $table->date("date");
            $table->double("payable");
            $table->double("paid")->nullable();
            $table->date("paid_date")->nullable();
            $table->unsignedBigInteger("emi_id");
            $table->foreign("emi_id")->references("id")->on("emis");
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
        Schema::dropIfExists('emi_entries');
    }
}
