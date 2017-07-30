<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('location');
            $table->string('scope');
            $table->string('type');
            $table->text('description');
            $table->string('rooms')->nullable();
            $table->string('bathrooms')->nullable();
            $table->string('sitting_room')->nullable();
            $table->string('size')->nullable();
            $table->string('property_type');
            $table->string('price');
            $table->string('coo_roo');
            $table->string('status');
            $table->integer('user_id')->unsigned();
            $table->integer('landlord_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('landlord_id')->references('id')->on('landlords');
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
        Schema::dropIfExists('properties');
    }

}
