<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Entry::class, function (Faker $faker) {
  $users = User::pluck('id')->all();
  return [
    'users_id' => $faker->randomElement($users),
    'creation_date' => $faker->date('Y-m-d'),
    'title' => $faker->sentence(5, true),
    'content' => $faker->paragraphs(20, true)
  ];
});
