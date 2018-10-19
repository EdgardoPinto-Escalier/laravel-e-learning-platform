<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // User roles Table
        Schema::create('user_roles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('name');
          $table->text('description');
          $table->timestamps();
        });

        // Users Table
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('role_id')->default(\App\UserRole::STUDENT);
            // Here we use a fereign key with a reference to the user_roles table.
            $table->foreign('role_id')->references('id')->on('user_roles');
            $table->string('name');
            $table->string('last_name')->nullable();
            $table->string('slug');
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->string('picture')->nullable();

            // Here we add the Cashier columns
  	        $table->string('stripe_id')->nullable();
  	        $table->string('card_brand')->nullable();
  	        $table->string('card_last_four')->nullable();
  	        $table->timestamp('trial_ends_at')->nullable();

  	        $table->rememberToken();
  	        $table->timestamps();
        });

        // Here we create the subscriptions table.
        Schema::create('subscriptions', function (Blueprint $table) {
    		    $table->increments('id');
    		    $table->unsignedInteger('user_id');
            // Here we use a fereign key with a reference to the users table.
    		    $table->foreign('user_id')->references('id')->on('users');
    		    $table->string('name');
    		    $table->string('stripe_id');
    		    $table->string('stripe_plan');
    		    $table->integer('quantity');
    		    $table->timestamp('trial_ends_at')->nullable();
    		    $table->timestamp('ends_at')->nullable();
    		    $table->timestamps();
    	    });

        // Finally we create the user_social_accounts table.
        Schema::create('user_social_accounts', function(Blueprint $table) {
    		    $table->increments('id');
    		    $table->unsignedInteger('user_id');
            // Here we use a fereign key with a reference to the users table.
    		    $table->foreign('user_id')->references('id')->on('users');
    		    $table->string('provider');
    		    $table->string('provider_uid');
         });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Here we drope the existent tables with the function down():
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_roles');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('user_social_accounts');
    }
}
