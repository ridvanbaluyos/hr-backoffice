<?php

use Illuminate\Database\Seeder;
use App\AccountInformation;

class AccountInformationTableSeeder extends Seeder
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
            AccountInformation::create(array(
                'user_id' => $i,
                'username' => $faker->userName,
                'password' => '$2y$10$PBWnyPP7IfxZ2rCip.w1S.dyP4/6/vT1KouOBASW2tmQxWqsQ7X1e',
                'email' => $faker->safeEmail,
                'role' => 'User',
                'biometrics_id' => $faker->sha256,
                'created_by' => 'ridvan@baluyos.net',
            ));
        }
    }
}
