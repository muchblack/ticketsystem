<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToReporting extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reportings', function (Blueprint $table) {
            //
            $table->integer('report_severity')->comment('嚴重性')->after('report_states');
            $table->integer('report_priority')->comment('優先等級')->after('report_severity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reportings', function (Blueprint $table) {
            //
        });
    }
}
