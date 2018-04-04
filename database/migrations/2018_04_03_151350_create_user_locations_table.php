<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLocationsTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('user_locations', function (Blueprint $table) {
      $table->increments('id');
      $table->timestamps();

      $table->integer('user_id')->unsigned();
      $table->foreign('user_id')->references('id')->on('users');

      $table->string('location', 255);
      $table->unique('location');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('user_locations');
  }
}
