<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ["nom" => "Ajouter un Client"],
            ["nom" => "Consulter un Client"],
            ["nom" => "Modifier un Client"],

            ["nom" => "Ajouter une Location"],
            ["nom" => "Consulter une Location"],
            ["nom" => "Modifier une Location"],

            ["nom" => "Ajouter un Article"],
            ["nom" => "Consulter un Article"],
            ["nom" => "Modifier un Article"]
        ]);
    }
}
