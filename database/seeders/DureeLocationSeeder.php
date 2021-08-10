<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DureeLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('duree_locations')->insert([
            ["libelle" => "Journée", "valeurEnHeure" => 24],
            ["libelle" => "Demi-Journée", "valeurEnHeure" => 12]
        ]);
    }
}
