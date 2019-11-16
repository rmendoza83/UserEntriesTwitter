<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Hashing\BcryptHasher;

class UserSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('users')->delete();
    // Default Users
    DB::table('users')->insert([
      'email' => 'misterchips@local',
      'name' => 'Mister Chip',
      'password' => (new BcryptHasher)->make('test'),
      'twitter_username' => '2010MisterChip'
    ]);
    DB::table('users')->insert([
      'email' => 'luisomartapia@local',
      'name' => 'Luis Omar Tapia',
      'password' => (new BcryptHasher)->make('test'),
      'twitter_username' => 'LuisOmarTapia'
    ]);
    factory(App\User::class, 10)->create();
  }
}
