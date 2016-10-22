<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('account_information', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('username', 32);
            $table->string('password', 256);
            $table->string('email', 32);
            $table->enum('role', ['Administrator', 'User']);
            $table->string('biometrics_id', 256);
            $table->index(['username']);
            $table->unique(['username']);
            $table->unique(['email']);
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
        Schema::drop('account_information');
    }
}
