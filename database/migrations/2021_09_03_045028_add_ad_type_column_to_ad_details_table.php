<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAdTypeColumnToAdDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ads_details', function (Blueprint $table) {
            $table->enum('ad_type',['VIDEO', 'BANNER'])->after('ad_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ads_details', function (Blueprint $table) {
            $table->dropColumn('ad_type');
        });
    }
}
