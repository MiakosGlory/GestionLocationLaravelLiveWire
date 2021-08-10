<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nom" => $this->faker->lastName,
            "numeroDeSerie" => $this->faker->randomNumber,
            "image" => $this->faker->imageUrl(),
            "estDisponible" => rand(0, 1),
            "type_article_id" => rand(1, 4)
        ];
    }
}
