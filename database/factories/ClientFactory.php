<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $pays = $this->faker->country;
        $ville = $this->faker->city;

        return [
            "nom" => $this->faker->lastName,
            "prenom" => $this->faker->firstName,
            "sexe" => array_rand(["M", "F"], 1),
            "dateNaissance" => $this->faker->dateTimeBetween("1980-01-01", "2002-12-31"),
            "lieuNaissance" => "$pays, $ville",
            "nationalite" => $pays,
            "ville" => $ville,
            "pays" => $pays,
            "adresse" => $this->faker->address,
            "telephone" => $this->faker->phoneNumber,
            "pieceIdentite" => array_rand(["CNI", "PASSPORT", "PERMIS DE CONDUIRE", 1]),
            "numeroPieceIdentite" => $this->faker->creditCardNumber
        ];
    }
}
