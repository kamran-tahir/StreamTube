<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChannelVerificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('channel_verification', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('channel_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->date('dob')->nullable();
            $table->string('ssn')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();  
            $table->integer('zip_code')->nullable();
            $table->integer('city_id')->nullable();          
            $table->integer('state_id')->nullable();
            $table->integer('country_id')->nullable();
            $table->tinyInteger('is_verified')->nullable()->comment('1 - verified , 0 - No');
            $table->text('decline_reasons')->nullable();
            $table->text('terms_and_conditions')->nullable();    
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
        Schema::drop('channel_verification');
    }
}
