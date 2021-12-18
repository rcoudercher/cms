<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Str;


class CommentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      return [
        'key' => Str::random(11),
        'user_id' => User::all()->random(),
        'article_id' => Article::all()->random(),
        'content' => $this->faker->text(400),
        'status' =>collect(['pending', 'approved', 'rejected'])->random(),
      ];
    }
}
