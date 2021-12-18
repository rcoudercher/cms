<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
  public function up()
  {
    Schema::create('people', function (Blueprint $table) {
      $table->id();
      $table->string('name');
      $table->string('slug')->unique();
      $table->date('date_of_birth');
      $table->string('place_of_birth');
      $table->date('date_of_death')->nullable();
      $table->string('place_of_death')->nullable();
      $table->text('description')->nullable();
      $table->text('content')->nullable();
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('people');
  }
}
