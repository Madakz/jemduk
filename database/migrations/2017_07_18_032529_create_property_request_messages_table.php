<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyRequestMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_request_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fullname');   
            $table->string('phone_number'); 
            $table->string('email');   
            $table->string('city_state')->nullable(); 
            $table->text('message');
            $table->integer('property_id')->unsigned();

            $table->foreign('property_id')->references('id')->on('properties'); 
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
        Schema::dropIfExists('property_request_messages');
    }
}
