<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_areas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('area_id')->unsigned()->index();
            $table->integer('travel_id')->unsigned()->index();
            $table->foreign('area_id')->references('id')->on('areas')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('travel_id')->references('id')->on('travels')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->date('check_in');
            $table->date('check_out');
            $table->string('hotel');
            $table->string('hotel_location');
            $table->integer('dbl_rooms');
            $table->integer('trbl_rooms');
            $table->integer('quad_rooms');
            $table->integer('nights');
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
        Schema::dropIfExists('travel_areas');
    }
}
