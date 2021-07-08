<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reportings', function (Blueprint $table) {
            $table->id();
            $table->string('report_title',50);
            $table->integer('report_type');
            $table->integer('report_states');
            $table->string('report_summary',100);
            $table->text('report_desc');
            $table->integer('created_user');
            $table->integer('updated_user');
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
        Schema::dropIfExists('reportings');
    }
}
