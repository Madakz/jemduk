<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLandlordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landlords', function (Blueprint $table) {
            $table->increments('id');
            $table->string('picture');
            $table->string('surname');
            $table->string('othername');
            $table->text('address');
            $table->string('phone_number');
            $table->string('email')->nullable();
            $table->string('gender');
            $table->string('bank_account');
            $table->string('bank_name');
            $table->string('state');
            $table->string('local_govt');
            $table->integer('user_id')->unsigned();

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
        Schema::dropIfExists('landlords');
    }
}
