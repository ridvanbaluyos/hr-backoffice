<?php

use Illuminate\Database\Seeder;
use App\SalaryInformation;

class SalaryInformationTableSeeder extends Seeder
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

        for ($i = 1; $i <= 100; $i++) {
            SalaryInformation::create(array(
                'user_id' => $i,
                'ot_applicable' => '1',
                'late_applicable' => '1',
                'undertime_applicable' => '1',
                'night_diff_applicable' => '1',
                'holiday_applicable' => '1',
                'has_sss' => '1',
                'has_withholding_tax' => '1',
                'has_philhealth' => '1',
                'has_pagibig' => '1',
                'with_previous_employer' => '1',
                'exclude_from_payroll' => '1',
                'exclude_from_tar' => '1',
                'created_by' => 'ridvan@baluyos.net',
            ));
        }
    }
}
