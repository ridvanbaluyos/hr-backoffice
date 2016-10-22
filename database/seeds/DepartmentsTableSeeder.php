<?php

use Illuminate\Database\Seeder;

class DepartmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            ['name' => 'Engineering'],
            ['name' => 'Product'],
            ['name' => 'Customer Success'],
            ['name' => 'Human Resources'],
            ['name' => 'Finance'],
            ['name' => 'Marketing'],
        ]);
    }
}
