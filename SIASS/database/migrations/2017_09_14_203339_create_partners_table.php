<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->string('user_id')->unique();
            $table->string('partnerName');
            $table->string('partnerAddress');
            $table->string('partnerEmail');
            $table->string('managerName');
            $table->string('managerMail');
            $table->string('managerPhone');
            $table->string('registeredBy');
        });

        Schema::table('partners', function($table) {
            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('registeredBy')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partners');
    }
}
