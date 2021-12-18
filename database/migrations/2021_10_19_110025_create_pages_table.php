<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
  public function up()
  {
    Schema::create('pages', function (Blueprint $table) {
      $table->id();
      $table->string('meta_title');
      $table->text('meta_description');
      $table->string('title');
      $table->text('content');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('pages');
  }
}
