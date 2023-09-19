<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdsDetailVideoTapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads_detail_video_tape', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ads_detail_id')->unsigned();
            $table->integer('video_tape_id')->unsigned();
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
        Schema::drop('ads_detail_video_tape');
    }
}
