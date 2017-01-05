<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('leave_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 32);
            $table->string('code', 8);
            $table->integer('days');
            $table->string('available_to', 32);
            $table->string('available_gender', 32);
            $table->boolean('is_incremental')->default(false)->nullable();
            $table->boolean('is_paid')->default(false)->nullable();
            $table->string('created_by', 32);
            $table->timestamps();
            $table->index(['id']);
            $table->unique(['name', 'code']);
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
        Schema::dropIfExists('leave_templates');
    }
}
