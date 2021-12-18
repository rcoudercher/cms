<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageSeeder extends Seeder
{
  public function run()
  {
    // delete all images in the public/images folder
    $files = Storage::allFiles('public/images');
    Storage::delete($files);
    
    Image::factory(30)->create();
  }
}
