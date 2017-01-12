<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerksGcsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('perks_gift_certificates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->date('month_year');
            $table->string('status', 32);
            $table->string('perk', 32);
            $table->string('created_by', 32);
            $table->timestamps();
            $table->index(['id']);
            $table->unique(['employee_id', 'month_year']);
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
        Schema::dropIfExists('perks_gift_certificates');
    }
}
