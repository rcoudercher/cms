<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;

class PageSeeder extends Seeder
{
  public function run()
  {
    Page::factory(10)->create();
  }
}
