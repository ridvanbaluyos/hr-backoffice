<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalaryInformation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('salary_information')) {
            Schema::create('salary_information', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->boolean('ot_applicable')->default(false)->nullable();
                $table->boolean('late_applicable')->default(false)->nullable();
                $table->boolean('undertime_applicable')->default(false)->nullable();
                $table->boolean('night_diff_applicable')->default(false)->nullable();
                $table->boolean('holiday_applicable')->default(false)->nullable();
                $table->boolean('has_sss')->default(false)->nullable();
                $table->boolean('has_withholding_tax')->default(false)->nullable();
                $table->boolean('has_philhealth')->default(false)->nullable();
                $table->boolean('has_pagibig')->default(false)->nullable();
                $table->boolean('with_previous_employer')->default(false)->nullable();
                $table->boolean('exclude_from_payroll')->default(false)->nullable();
                $table->boolean('exclude_from_tar')->default(false)->nullable();
                $table->string('created_by', 32);
                $table->timestamps();
                $table->index(['user_id']);
                $table->unique(['user_id']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('salary_information');
    }
}
