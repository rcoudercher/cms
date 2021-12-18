<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
  protected $model = Category::class;
  
  public function definition()
  {
    
    $names = collect([
      'Corona',
      'Science',
      'Travel',
      'Politics',
      'Q&A',
      'Economics',
      'Cinema',
      'Censorship',
      'France',
      'US',
      'Russia',
      'South America',
      'China',
      'Technology',
      'Medias',
      'Business',
      'Climate',
      'Sport'
    ]);
    
    $name = $names->random();
    
    $picked = Category::all()->pluck('name')->toArray();
        
    while (in_array($name, $picked)) {
      $name = $names->random();
    }
    
    $slug = Str::slug($name, '-').'-'.Str::random(15);
    
    return [
      'name' => $name,
      'slug' => $slug,
    ];
  }
}
