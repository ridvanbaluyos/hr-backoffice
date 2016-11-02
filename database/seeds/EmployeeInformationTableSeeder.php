<?php

use Illuminate\Database\Seeder;
use App\EmployeeInformation;

class EmployeeInformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 100; $i++) {
            $gender = array_rand(config('formvalues.gender'));

            EmployeeInformation::create(array(
                'employee_number' => 'N-' . str_pad($faker->randomNumber(6), 6, '0') . '-' . str_pad($i, 4, '0'),   // N-120910-0095
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName($gender),
                'middle_name' => $faker->lastName,
                'gender' => $gender,
                'marital_status' => array_rand(config('formvalues.marital_status')),
                'birthdate' => $faker->date($format = 'Y-m-d'),
                'employee_status' => array_rand(config('formvalues.employee_status')),
                'date_hired' => $faker->date($format = 'Y-m-d'),
                'date_regularized' => $faker->date($format = 'Y-m-d'),
                'department_id' => $faker->numberBetween(1, 7),
                'created_by' => 'ridvan@baluyos.net',
                'team_id' => $faker->numberBetween(1, 5),
            ));
        }
    }
}
