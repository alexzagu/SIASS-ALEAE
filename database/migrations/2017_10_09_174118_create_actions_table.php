<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actions', function (Blueprint $table) {
            $table->string('social_service_id');
            $table->boolean('field1');
            $table->boolean('field2');
            $table->boolean('field3');
        });

        Schema::table('actions', function (Blueprint $table) {
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
        Schema::dropIfExists('actions');
    }
}
