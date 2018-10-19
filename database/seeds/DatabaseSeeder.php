<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // The following two actions are for when it's necessary to
       // initialize the database and make new migrations with fresh content.

      // First we delete the courses and users directory.
      Storage::deleteDirectory('courses');
      Storage::deleteDirectory('users');
      // Then, after we create those directories again with fresh content.
      Storage::makeDirectory('courses');
      Storage::makeDirectory('users');

      // Next we create 3 roles using the factories and the UserRole model.
      factory(\App\UserRole::class, 1)->create(['name' => 'admin']);
      factory(\App\UserRole::class, 1)->create(['name' => 'teacher']);
      factory(\App\UserRole::class, 1)->create(['name' => 'student']);

      // Here using factory create one user (admin) with the following details:
      factory(\App\User::class, 1)->create([
        'name' => 'admin',
        'email' => 'admin@mail.com',
        'password' => bcrypt('secret'),
        'role_id' => \App\UserRole::ADMIN
      ])
      // Here using the each() and an anomym function we make this user a student also.
      // Everyone on this platform will be a student also.
      ->each(function (\App\User $u) {
        factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
      });

        // Next we create some regular users.
        factory(\App\User::class, 5)->create()
          // Same as we did above, we make this users students.
          ->each(function (\App\User $u) {
            factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
        });

        // Next we create some teacher.
        factory(\App\User::class, 5)->create()
          ->each(function (\App\User $u) {
            // and we make them students also, creating the relation with student.
          factory(\App\Student::class, 1)->create(['user_id' => $u->id]);
          factory(\App\Teacher::class, 1)->create(['user_id' => $u->id]);
        });

        // Next we create the Levels for the different type of courses and the categories.
        factory(\App\Level::class, 1)->create(['name' => 'Beginner']);
        factory(\App\Level::class, 1)->create(['name' => 'Intermediate']);
        factory(\App\Level::class, 1)->create(['name' => 'Advanced']);
        factory(\App\Category::class, 5)->create();

        // Finally we create the courses.
        factory(\App\Course::class, 5)
		    ->create()
		    ->each(function (\App\Course $c) {
		    	$c->goals()->saveMany(factory(\App\Goal::class, 2)->create());
		    	$c->requirements()->saveMany(factory(\App\Requirement::class, 2)->create());
		    });
    }
}
