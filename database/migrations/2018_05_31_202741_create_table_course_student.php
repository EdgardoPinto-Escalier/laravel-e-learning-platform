<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableCourseStudent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the course_student table.
        Schema::create('course_student', function (Blueprint $table) {
          $table->unsignedInteger('course_id');
          // Here we have the foreign key with a reference to the courses table.
          $table->foreign('course_id')->references('id')->on('courses');
          $table->unsignedInteger('student_id');
          // Here we have the foreign key with a reference to the students table.
          $table->foreign('student_id')->references('id')->on('students');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Here we can drop the course_student table with the function down().
        Schema::dropIfExists('course_student');
    }
}
