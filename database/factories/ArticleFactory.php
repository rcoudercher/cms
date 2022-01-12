<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Author;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class ArticleFactory extends Factory
{
  protected $model = Article::class;

  public function definition()
  {
    $title = $this->faker->sentence(8, false);
        
    $published_at = null;
    
    if (rand(0,1)) {
      $published_at = Carbon::now();
    }
        
    return [
      'key' => Str::random(11),
      'author_id' => Author::all()->random(),
      'category_id' => Category::all()->random(),
      'image_id' => Image::all()->random(),
      'title' => $title,
      'description' => $this->faker->sentence(20),
      'content' => $this->faker->text(2000),
      'slug' => Str::slug($title, '-'),
      'published_at' => $published_at,
    ];
  }
}
