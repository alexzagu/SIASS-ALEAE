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
            $table->unsignedInteger('totalCertifiedHoursSSC');
            $table->unsignedInteger('totalRegisteredHoursSSC');
            $table->unsignedInteger('totalCertifiedHoursSSP');
            $table->unsignedInteger('totalRegisteredHoursSSP');
            $table->string('studentStatus');
            $table->unsignedInteger('semester');
            $table->unsignedInteger('certifiedUnits');
            $table->string('campus');
            $table->string('mainPhone');
            $table->string('secondaryPhone');
            $table->dateTime('introductionCouseStart');
            $table->dateTime('introductionCourseEnd');
            $table->boolean('introductionCourseCertified');
            $table->dateTime('recCourseStars');
            $table->dateTime('recCourseUpload');
            $table->boolean('recCourseCertified');
            $table->boolean('isCertified')->default(0);
            $table->dateTime('certificationDate')->nullable();
            $table->boolean('isCertificationEmailSent')->default(0);
            $table->dateTime('certificationEmailSendDate')->nullable();
            $table->softDeletes();
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
