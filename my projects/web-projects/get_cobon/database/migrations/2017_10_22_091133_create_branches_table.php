<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->integer('voters')->default(0);
            $table->integer('vote_sum')->default(0);
            $table->string('location')->nullable();
            $table->softDeletes();
            $table->integer('city_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->string('phone_number', 12);
            // $table->foreign('city_id')->refrences('id')->on('cities')->onUpdate('cascade');
            // $table->foreign('vendor_id')->refrences('id')->on('vendors')->onUpdate('cascade');
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
        Schema::dropIfExists('branches');
    }
}
