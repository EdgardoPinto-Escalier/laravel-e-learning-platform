<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the requirements table.
        Schema::create('requirements', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('course_id');
          // Here we have the foreign key with a reference to the courses table.
          $table->foreign('course_id')->references('id')->on('courses');
          $table->string('requirement');
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
        // Here we can drop the requirements table with the function down().
        Schema::dropIfExists('requirements');
    }
}
