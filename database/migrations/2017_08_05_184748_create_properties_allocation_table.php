<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesAllocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_allocations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname');   
            $table->string('othernames'); 
            $table->string('amount_paid_figure');
            $table->text('amount_paid_words');
            $table->string('supposed_amount');
            $table->string('balance_due');
            $table->string('from_date');
            $table->string('to_date');
            $table->text('description');
            $table->string('payment_category');
            $table->string('recieved_by');     //stores the name of the person to whom money was handed to
            $table->string('phone_number');
            $table->integer('property_id')->unsigned();
            $table->integer('user_id')->unsigned();     //stores the agent id

            // $table->foreign('property_id')->references('id')->on('properties'); 
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();     //store the current time in which the details are store
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropifExists('properties_allocations');
    }
}
