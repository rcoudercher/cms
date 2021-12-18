<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

class PersonFactory extends Factory
{
  protected $model = Person::class;

  public function definition()
  {
    $name = $this->faker->name;
    
    $dateOfDeath = $this->faker->date('Y-m-d');
    $dateOfBirth = $this->faker->date('Y-m-d', $dateOfDeath);
            
    $isAlive = rand(0,1);
    
    if ($isAlive) {
      $dateOfDeath = null;
      $placeOfDeath = null;
    } else {
      $placeOfDeath = $this->faker->city;
    }

    return [
      'name' => $name,
      'slug' => Str::slug($name, '-'),
      'date_of_birth' => $dateOfBirth,
      'place_of_birth' => $this->faker->city,
      'date_of_death' => $dateOfDeath,
      'place_of_death' => $placeOfDeath,
      'description' => $this->faker->sentences(3, true),
      'content' => $this->faker->sentences(15, true)
    ];
  }
}
