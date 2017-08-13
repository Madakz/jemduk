<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGetIntouchMessagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('get_intouch_messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');   
            $table->string('last_name'); 
            $table->string('email');   
            $table->text('subject')->nullable(); 
            $table->text('message'); 
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
        Schema::dropIfExists('get_intouch_messages');
    }
}
