<?php

use Illuminate\Database\Seeder;
use App\SalaryInformation;
use App\AccountInformation;
use App\EmployeeInformation;
use App\User;
use App\Team;
use App\GiftCertificates;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 1; $i <= 100; $i++) {
            $gender = array_rand(config('formvalues.gender'));
            $lastName = $faker->lastName;
            $firstName = $faker->firstName($gender);
            $middleName = $faker->lastName;
            $email = $faker->safeEmail;
            $password = '$2y$10$PBWnyPP7IfxZ2rCip.w1S.dyP4/6/vT1KouOBASW2tmQxWqsQ7X1e'; // abcxyz123

            $department = $faker->numberBetween(1, 7);
            $teamDepartments = Team::where('department_id', '=', $department)->get()->toArray();
            foreach ($teamDepartments as $team) {
                $possibleTeams[] = $team['id'];
            }
            $team = $faker->randomElement($possibleTeams);

            AccountInformation::create(array(
                'user_id' => $i,
                'username' => strtolower($firstName . '.' . $lastName),
                'password' => $password,
                'email' => $email,
                'role' => 'User',
                'biometrics_id' => $faker->sha256,
                'created_by' => 'ridvan@baluyos.net',
            ));


            EmployeeInformation::create(array(
                'employee_number' => 'N-' . str_pad($faker->randomNumber(6), 6, '0') . '-' . str_pad($i, 4, '0'),   // N-120910-0095
                'last_name' => $lastName,
                'first_name' => $firstName,
                'middle_name' => $middleName,
                'gender' => $gender,
                'marital_status' => array_rand(config('formvalues.marital_status')),
                'birthdate' => $faker->date($format = 'Y-m-d'),
                'employee_status' => array_rand(config('formvalues.employee_status')),
                'date_hired' => $faker->date($format = 'Y-m-d'),
                'date_regularized' => $faker->date($format = 'Y-m-d'),
                'department_id' => $department,
                'created_by' => 'ridvan@baluyos.net',
                'team_id' => $team,
            ));

            User::create(array(
                'name' => $firstName . ' ' . $middleName . ' ' . $lastName,
                'email' => $email,
                'password' => $password,
                'remember_token' => $faker->sha256,
            ));

            foreach (range (1,12) as $month) {
                GiftCertificates::create(array(
                    'employee_id' => $i,
                    'month_year' => Carbon::createFromDate(date('Y'), $month, 1, 'Asia/Manila')->format('Y-m-d'),
                    'status' => $faker->randomElement(['submitted', 'claimed']),
                    'perk' => $faker->randomElement(array_keys(config('formvalues.gift_certificates'))),
                    'created_by' => $email
                ));
            }

        }
    }
}
