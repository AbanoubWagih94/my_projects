<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->date('end_date');
            $table->text('description');
            $table->text('included');
            $table->text('excluded');
            $table->text('offer_terms');
            $table->string('title');
            $table->decimal('main_price', 6, 2);
            $table->decimal('offer_price', 6, 2);
            $table->integer('voters')->default(0);
            $table->integer('vote_sum')->default(0);
            $table->softDeletes();
            $table->integer('vendor_id')->unsigned();
            $table->index('vendor_id');
            $table->integer('buying_count')->default(0);
            // $table->foreign('branch_id')->refrences('id')->on('branches')->onUpdate('cascade');
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
        Schema::dropIfExists('offers');
    }
}
