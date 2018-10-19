<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the goals table.
        Schema::create('goals', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('course_id');
          // Here we have the foreign key with a reference to the courses table.
          $table->foreign('course_id')->references('id')->on('courses');
          $table->string('goal');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Here we can drop the goals table with the function down().
        Schema::dropIfExists('goals');
    }
}
