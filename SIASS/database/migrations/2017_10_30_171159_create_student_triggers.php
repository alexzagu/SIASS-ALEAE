<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentTriggers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER tr_update_certified_flag BEFORE UPDATE ON `students` FOR EACH ROW
            BEGIN
                IF (NEW.totalCertifiedHoursSS >= 480 AND OLD.isCertified = 0) THEN
                    SET NEW.isCertified = 1;
                    SET NEW.certificationDate = now();
                END IF;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('DROP TRIGGER `tr_update_certified_flag`');
    }
}
