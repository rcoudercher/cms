<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Config;

class ConfigSeeder extends Seeder
{
  public function run()
  {
    Config::create(['name' => 'main-block-article', 'value' => '3']);
    Config::create(['name' => 'mini-view-article-1', 'value' => '4']);
    Config::create(['name' => 'mini-view-article-2', 'value' => '5']);
    Config::create(['name' => 'mini-view-article-3', 'value' => '6']);
    Config::create(['name' => 'mini-view-article-4', 'value' => '7']);
  }
}
