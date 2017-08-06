<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesSoldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_sold', function (Blueprint $table) {
            $table->increments('id');
            $table->string('surname');   
            $table->string('othernames'); 
            $table->string('amount_paid_figure');
            $table->string('amount_paid_words');
            $table->string('supposed_amount');
            $table->string('balance_due');
            $table->string('description');
            $table->string('payment_category');
            $table->string('recieved_by');
            $table->string('landlord_name');
            $table->string('client_address');
            $table->string('client_witness_name'); 
            $table->string('client_witness_phone_number');
            $table->string('client_witness_address');
            $table->string('landlord_witness_name');
            $table->string('landlord_witness_phone_number');
            $table->string('landlord_witness_address');
            $table->integer('property_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('property_id')->references('id')->on('properties'); 
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropifExists('properties_sold');
    }
}
