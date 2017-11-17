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
     /*
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
    */

    public function up()
    {
        DB::unprepared("
        CREATE OR REPLACE FUNCTION updateCertifiedFlagFunction() RETURNS TRIGGER
            AS '
            BEGIN
                IF (NEW.totalCertifiedHoursSS >= 480 AND OLD.isCertified = 0) THEN
                    NEW.isCertified := 1;
                    NEW.certificationDate := now();
                END IF;
            END' LANGUAGE 'plpgsql';
        ");

        DB::unprepared('
        CREATE TRIGGER tr_update_certified_flag AFTER UPDATE ON students FOR EACH ROW
            EXECUTE PROCEDURE updateCertifiedFlagFunction();
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
