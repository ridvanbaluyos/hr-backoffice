<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamManagersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('team_managers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('employee_id');
            $table->integer('team_id');
            $table->string('created_by', 32);
            $table->timestamps();
            $table->index(['id']);
            $table->unique(['employee_id', 'team_id']);
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
        Schema::dropIfExists('team_managers');
    }
}
