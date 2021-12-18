<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
  protected $model = Page::class;

  public function definition()
  {
    $title = $this->faker->sentence(4);
    
    return [
      'meta_title' => $title,
      'meta_description' => $this->faker->sentences(2, true),
      'title' => $title,
      'content' => $this->faker->sentences(15, true),
    ];
  }
}
