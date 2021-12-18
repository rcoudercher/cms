<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
  public function up()
  {
    Schema::create('images', function (Blueprint $table) {
      $table->id();
      $table->string('path')->unique();
      $table->string('url')->unique();
      $table->string('credit')->nullable();
      $table->string('original_name');
      $table->string('extension');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('images');
  }
}
