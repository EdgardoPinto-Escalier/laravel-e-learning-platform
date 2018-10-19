<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the reviews table.
        Schema::create('reviews', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('course_id');
          // Here we have the foreign key with a reference to the courses table.
          $table->foreign('course_id')->references('id')->on('courses');
          $table->unsignedInteger('user_id');
          // Here we have the foreign key with a reference to the users table.
          $table->foreign('user_id')->references('id')->on('users');
          $table->integer('rating');
          $table->text('comment')->nullable();
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
        // Here we can drop the reviews table with the function down().
        Schema::dropIfExists('reviews');
    }
}
