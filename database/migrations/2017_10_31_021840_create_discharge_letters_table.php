<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDischargeLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discharge_letters', function (Blueprint $table) {
            $table->string('student_service_id');
            $table->string('file_name');
            $table->string('link');
            $table->string('MIME');
            $table->dateTime('uploaded_at');
        });

        Schema::table('discharge_letters', function (Blueprint $table) {
            $table->primary('student_service_id');
            $table->foreign('student_service_id')->references('id')->on('student_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discharge_letters');
    }
}
