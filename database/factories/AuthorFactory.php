<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class AuthorFactory extends Factory
{
  protected $model = Author::class;
  
  public function definition()
  {  
    $names = collect([
      'Pierre Jean',
      'Paul Francois',
      'Jacques Paul',
      'Emma Benoit',
      'Sofia Jean',
      'Nicolas Paul',
      'Francois Francois',
      'Paula Benoit',
      'Nestor Jean',
      'Hector Paul',
      'Benedicte Francois',
      'Benoit Benoit',
      'Jean Paul'
    ]);
    
    $name = $names->random();
    
    $picked = Author::all()->pluck('name')->toArray();
    
    while (in_array($name, $picked)) {
      $name = $names->random();
    }
    
    $slug = Str::slug($name, '-').'-'.Str::random(15);
    
    return [
      'name' => $name,
      'slug' => $slug
    ];
    
    
  }
}
