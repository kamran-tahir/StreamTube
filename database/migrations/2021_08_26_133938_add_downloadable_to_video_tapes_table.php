<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDownloadableToVideoTapesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('video_tapes', function (Blueprint $table) {
            $table->boolean('downloadable')->default(0)->after('ad_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('video_tapes', function (Blueprint $table) {
            $table->dropColumn('downloadable');
        });
    }
}
