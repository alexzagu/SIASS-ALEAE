<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Period;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //User seeder---------------------------------------------
        for ($i = 1; $i <= 12; $i++) {

            if ($i % 3 == 0) {
                $role = 'administrator';
                $id = $i > 9 ? 'L000000' . $i : 'L0000000' . $i;
                $name = 'User ' . $i;
                $email = $id . '@itesm.mx';
                $username = $id;

            } elseif ($i % 3 == 1) {
                $role = 'partner';
                $id = 'PARTNER2017' . $i;
                $name = 'User ' . $i;
                $email = $id . '@gmail.com';
                $username = $id;

            } else {
                $role = 'student';
                $id = $i > 9 ? 'A000000' . $i : 'A0000000' . $i;
                $name = 'User ' . $i;
                $email = $id . '@itesm.mx';
                $username = $id;
            }

            $password = 'testing';

            DB::table('users')->insert([
                'id' => $id,
                'name' => $name,
                'email' => $email,
                'password' => bcrypt($password),
                'username' => $username,
                'role' => $role
            ]);
        }

        $users = User::all();

        $registeredBy = 'L00000001';

        foreach($users as $user) {
            $role = $user->role;

            switch ($role) {
                case 'administrator':
                    DB::table('administrators')->insert([
                        'user_id' => $user->id,
                        'department' => 'Test Department',
                        'phone' => '12345678',
                        'phoneExtension' => '0987'
                    ]);

                    $registeredBy = $user->id;
                    break;
                case 'partner':
                    DB::table('partners')->insert([
                        'user_id' => $user->id,
                        'partnerName' => 'Partner Association',
                        'partnerAddress' => 'Partner Address 123',
                        'partnerEmail' => 'partner@gmail.com',
                        'managerName' => $user->name,
                        'managerMail' => $user->email,
                        'managerPhone' => '12345678',
                        'registeredBy' => $registeredBy,
                        'defaultPasswordChanged' => 0
                    ]);
                    break;
                case 'student':

                    $dateStart = now();
                    $dateEnd = now()->add(new DateInterval('P7D'));

                    DB::table('students')->insert([
                        'user_id' => $user->id,
                        'major' => 'ITC',
                        'studyPlan' => 'ITC11',
                        'totalCertifiedHoursSSC' => 260,
                        'totalRegisteredHoursSSC' => 0,
                        'totalCertifiedHoursSSP' => 100,
                        'totalRegisteredHoursSSP' => 0,
                        'totalCertifiedHoursSS' => 360,
                        'totalRegisteredHoursSS' => 0,
                        'studentStatus' => 'Regular Student',
                        'semester' => 9,
                        'certifiedUnits' => 560,
                        'campus' => 'Monterrey',
                        'mainPhone' => '12345678',
                        'secondaryPhone' => '98765432',
                        'introductionCouseStart' => $dateStart,
                        'introductionCourseEnd' => $dateEnd,
                        'introductionCourseCertified' => false,
                        'recCourseStars' => $dateStart,
                        'recCourseUpload' => $dateEnd,
                        'recCourseCertified' => false
                    ]);
                    break;
            }
        }
        //User seeder---------------------------------------------

        //Period seeder---------------------------------
        $year = date('Y');

        for ($i = 11; $i < 14; $i++) {

            $period = "";

            switch ($i) {
                case 11:
                    $period = 'Enero - Mayo';
                    $period_key = 11;
                    break;
                case 12:
                    $period = 'Verano';
                    $period_key = 12;
                    break;
                case 13:
                    $period = 'Agosto - Diciembre';
                    $period_key = 13;
                    break;
            }

            Period::create([
                'id' => $year . $period_key,
                'name' => $period . ' ' . $year
            ]);
        }
        //Period seeder---------------------------------
    }
}
