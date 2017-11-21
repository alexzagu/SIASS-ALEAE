<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSensibilizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sensibilizations', function (Blueprint $table) {
            $table->string('social_service_id');
            $table->boolean('ethical_recognition');
            $table->boolean('empathy');
            $table->boolean('moral_judgement');
        });

        Schema::table('sensibilizations', function (Blueprint $table) {
            $table->primary('social_service_id');
            $table->foreign('social_service_id')->references('id')->on('social_services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sensibilizations');
    }
}
