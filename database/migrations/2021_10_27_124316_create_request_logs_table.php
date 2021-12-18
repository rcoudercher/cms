<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestLogsTable extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
    Schema::create('request_logs', function (Blueprint $table) {
      $table->id();
      $table->dateTime('date');
      $table->string('method');
      $table->smallInteger('status');
      $table->string('uri');
      $table->string('url');
      $table->string('fullUrl');
      $table->string('ipAddress');
      $table->string('referer');
      $table->text('userAgent');
      $table->dateTime('created_at');
    });
  }

  /**
  * Reverse the migrations.
  *
  * @return void
  */
  public function down()
  {
    Schema::dropIfExists('request_logs');
  }
}
