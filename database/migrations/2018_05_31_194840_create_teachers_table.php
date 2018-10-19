<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Here we create the teachers table.
        Schema::create('teachers', function (Blueprint $table) {
          $table->increments('id');
          $table->unsignedInteger('user_id');
          // Here we have the foreign key with a reference to the users table.
          $table->foreign('user_id')->references('id')->on('users');
          $table->string('title')->nullable();
          $table->text('biography')->nullable();
          $table->string('website_url')->nullable();
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
        // Here we can drop the teachers table with the function down().
        Schema::dropIfExists('teachers');
    }
}
