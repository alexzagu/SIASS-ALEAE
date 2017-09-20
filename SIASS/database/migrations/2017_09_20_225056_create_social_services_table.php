<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocialServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('social_services', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('partner_id');
            $table->string('name');
            $table->string('description');
            $table->integer('totalHours');
            $table->string('address');
            $table->string('managerName');
            $table->string('managerMail');
            $table->string('managerPhone');
            $table->integer('capability');
            $table->integer('currentCapability');
            $table->date('startDate');
            $table->date('endDate');
            $table->string('type');
            $table->string('period');
            $table->string('campus');
        });

        Schema::table('social_services', function (Blueprint $table) {
            $table->primary('id');

            $table->foreign('partner_id')->references('user_id')->on('partners');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
