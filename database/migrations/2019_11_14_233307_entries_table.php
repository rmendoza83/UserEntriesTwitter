<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EntriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('entries', function (Blueprint $table) {
      $table->bigIncrements('id');
      $table->bigInteger('id_user');
      $table->date('creation_date');
      $table->string('title', 80);
      $table->string('content', 10000);
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
    Schema::dropIfExists('entries');
  }
}
