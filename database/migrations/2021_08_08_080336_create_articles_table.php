<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
  public function up()
  {
    Schema::create('articles', function (Blueprint $table) {
      $table->id();
      $table->string('key')->unique();
      $table->unsignedBigInteger('author_id')->nullable();
      $table->unsignedBigInteger('category_id')->nullable();
      $table->unsignedBigInteger('image_id')->nullable();
      $table->string('title');
      $table->text('description');
      $table->text('content');
      $table->string('slug')->unique();
      $table->dateTime('published_at')->nullable()->default(null);
      $table->dateTime('scheduled_at')->nullable()->default(null);
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('articles');
  }
}
