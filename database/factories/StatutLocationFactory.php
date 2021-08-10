<?php

namespace Database\Factories;

use App\Models\StatutLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class StatutLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StatutLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "nom" => array_rand(["En cours", "Terminée", "En attente"], 1)
        ];
    }
}
