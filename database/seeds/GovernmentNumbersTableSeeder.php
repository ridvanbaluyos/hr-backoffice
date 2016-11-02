<?php

use Illuminate\Database\Seeder;
use App\GovernmentNumber;

class GovernmentNumbersTableSeeder extends Seeder
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
            GovernmentNumber::create(array(
                'user_id' => $i,
                'tin' => str_pad($i . $faker->numberBetween(1, 9999) . $i, 11, '0'),
                'philhealth' => str_pad($i . $faker->numberBetween(1, 9999) . $i, 10, '0'),
                'pagibig' => str_pad($i . $faker->numberBetween(1, 9999) . $i, 10, '0'),
                'sss' => str_pad($i . $faker->numberBetween(1, 9999) . $i, 8, '0'),
                'tax_status' => array_rand(config('formvalues.tax_status')),
                'philhealth_effectivity_date' => $faker->date($format = 'Y-m-d'),
                'pagibig_contribution' => $faker->randomFloat(2, 0, 2000),
                'withholding_tax' => (string)array_rand(config('formvalues.withholding_tax')),
                'created_by' => 'ridvan@baluyos.net',
            ));
        }
    }
}
