<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTravelSightSeeingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('travel_sight_seeings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_area_id')->unsigned()->index();
            $table->integer('sight_seeing_id')->unsigned()->index();
            $table->foreign('travel_area_id')->references('id')->on('travel_areas')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('sight_seeing_id')->references('id')->on('sight_seeings')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->date('date');
            $table->time('time');
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
        Schema::dropIfExists('travel_sight_seeings');
    }
}
