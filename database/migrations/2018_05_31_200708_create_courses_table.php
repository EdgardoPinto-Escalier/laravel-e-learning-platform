<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the courses table.
        Schema::create('courses', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('teacher_id');
          // Here we have the foreign key with a reference to the teachers table.
          $table->foreign('teacher_id')->references('id')->on('teachers');
          $table->unsignedInteger('category_id');
          // Here we have the foreign key with a reference to the categories table.
          $table->foreign('category_id')->references('id')->on('categories');
          $table->unsignedInteger('level_id');
          // Here we have the foreign key with a reference to the levels table.
          $table->foreign('level_id')->references('id')->on('levels');
          $table->string('name');
          $table->text('description');
          $table->string('slug'); // Friendly URL.
          $table->string('picture')->nullable();
          $table->enum('status', [ // Column of type enum, to define a name and different options.
            \App\Course::PUBLISHED, \App\Course::PENDING, \App\Course::REJECTED
          ])->default(\App\Course::PENDING); // When a new course is created it will have always and only Pending status.
          $table->boolean('previous_approved')->default(false);
          $table->boolean('previous_rejected')->default(false);
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Here we can drop the courses table with the function down().
        Schema::dropIfExists('courses');
    }
}
