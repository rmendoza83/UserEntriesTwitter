<?php

use Illuminate\Database\Seeder;

class EntrySeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table('entries')->delete();
    factory(App\Entry::class, 50)->create();
  }
} 
