<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->string('user_id')->unique();
            $table->string('major');
            $table->string('studyPlan');
            $table->integer('totalCertifiedHoursSSC')->unsigned();
            $table->integer('totalRegisteredHoursSSC')->unsigned();
            $table->integer('totalCertifiedHoursSSP')->unsigned();
            $table->integer('totalRegisteredHoursSSP')->unsigned();
            $table->integer('totalCertifiedHoursSS')->unsigned();
            $table->string('studentStatus');
            $table->integer('semester')->unsigned();
            $table->integer('certifiedUnits')->unsigned();
            $table->string('campus');
            $table->string('mainPhone');
            $table->string('secondaryPhone');
        });

        Schema::table('students', function($table) {
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
