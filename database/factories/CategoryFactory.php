<?php

use Faker\Generator as Faker;

$factory->define(App\Category::class, function (Faker $faker) {
    return [
      'name' => $faker->unique()->randomElement([
          'PHP',
          'JAVASCRIPT',
          'ANGULAR',
          'REACT',
          'VUEJS',
          'MYSQL',
          'HTML',
          'CSS',
          'PYTHON',
          'JQUERY',
          'RUBY ON RAILS',
          'LARAVEL'
        ]),
      'description' => $faker->sentence
    ];
});
