<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_services', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('user_id');
            $table->string('service_id');
            $table->string('studentName');
            $table->integer('certifiedHours');
            $table->integer('registeredHours');
            $table->string('status');
            $table->string('dischargeLetter');
        });

        Schema::table('student_services', function (Blueprint $table) {
            $table->primary('id');

            $table->foreign('user_id')->references('user_id')->on('students');
            $table->foreign('service_id')->references('id')->on('social_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_services');
    }
}
