<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGovernmentNumbers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        if (!Schema::hasTable('government_numbers')) {
            Schema::create('government_numbers', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('tin', 32);
                $table->string('philhealth', 32);
                $table->string('pagibig', 32);
                $table->string('sss', 32);
                $table->enum('tax_status', ['S', 'S1', 'S2', 'S3', 'S4', 'ME', 'ME1', 'ME2', 'ME3', 'ME4', 'Z']);
                $table->date('philhealth_effectivity_date');
                $table->float('pagibig_contribution');
                $table->enum('withholding_tax', ['2', '10', '15']);
                $table->string('created_by', 32);
                $table->timestamps();
                $table->index(['user_id']);
                $table->unique(['tin']);
                $table->unique(['philhealth']);
                $table->unique(['pagibig']);
                $table->unique(['sss']);
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
        Schema::drop('government_numbers');
    }
}
