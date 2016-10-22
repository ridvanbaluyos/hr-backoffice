<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeeInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('employee_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('last_name', 32);
            $table->string('first_name', 32);
            $table->string('middle_name', 32);
            $table->enum('gender', ['Male', 'Female']);
            $table->enum('marital_status', ['Single', 'Married', 'Separated', 'Widowed']);
            $table->date('birthdate');
            $table->enum('employee_status', ['Probationary', 'Permanent', 'Contractual']);
            $table->date('date_hired');
            $table->date('date_regularized');
            $table->integer('department_id');
            $table->integer('team_id');
            $table->timestamps();
            $table->index(['last_name']);
            $table->index(['department_id']);
            $table->index(['team_id']);
            $table->unique(['last_name', 'first_name', 'middle_name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('employee_information');
    }
}
