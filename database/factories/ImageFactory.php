<?php

namespace Database\Factories;

use App\Models\Image;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageFactory extends Factory
{
  protected $model = Image::class;

  public function definition()
  {
    // $images = collect([
    //   'storage/app/images/00TRIPPEDUP-EUROVACCINE-videoLarge.jpeg',
    //   'storage/app/images/02TrippedUp2-illo-videoLarge.jpeg',
    //   'storage/app/images/06firestourism1-videoLarge.jpeg',
    //   'storage/app/images/14virus-travelbans-greece-videoLarge.jpeg',
    //   'storage/app/images/18europe-sick1-videoLarge-v3.jpeg',
    //   'storage/app/images/23travel-mongolia-promo-2-videoLarge.jpeg',
    //   'storage/app/images/25travel-burst-4-jumbo.jpeg',
    //   'storage/app/images/28Trippedup-illo-videoLarge-v2.jpeg',
    //   'storage/app/images/28Trippeup-illo-videoLarge.jpeg',
    //   'storage/app/images/merlin_189759048_89a7abb1-4cb7-4023-8593-42e96334cd25-videoLarge.jpeg',
    //   'storage/app/images/merlin_189764418_a0830cb3-5be2-47a1-b8be-dd5b0fa9c04b-videoLarge.jpeg',
    //   'storage/app/images/merlin_193372122_38b17c57-4c5a-412d-8c6f-9c1ee4ce285c-videoLarge.jpeg',
    //   'storage/app/images/oakImage-1628261883468-videoLarge.jpeg',
    //   'storage/app/images/TR-AIRLINENIGHTMARES-videoLarge.jpeg',
    //   'storage/app/images/TR-TRAVELPRICES-videoLarge.jpeg',
    //   'storage/app/images/TR-TRIPPEUP-VACCINATION-videoLarge.jpg',
    //   'storage/app/images/travel-slackline-video-3-still-videoLarge.jpeg',
    //   'storage/app/images/xxcruises-delta-videoLarge.jpeg',
    // ]);
    
    // $url = $images->random();

    // TESTING
    $url = 'https://via.placeholder.com/600x338.png';
    
    $info = pathinfo($url);
    $contents = file_get_contents($url);
    $file = '/tmp/' . $info['basename'];
    file_put_contents($file, $contents);
    $image = new UploadedFile($file, $info['basename']);
    $path = $image->store('public/images');
    $url = Storage::url($path);
    
    return [
      'path' => $path,
      'url' => $url,
      'credit' => $this->faker->sentence(2, true),
      'original_name' => $image->getClientOriginalName(),
      'extension' => $image->extension(),
    ];
  }
}






