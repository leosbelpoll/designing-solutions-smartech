<?php

use App\Project;
use App\Standard;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create Initial Projects

        Project::insert([/* id => 1 */'name' => 'Tuneles']);
        Project::insert([/* id => 2 */'name' => 'Aracataca']);


        // Create Standards

        Standard::insert([/* id => 1 */'name' => 'Gestión Ambiental (14001)']);
        Standard::insert([/* id => 2 */'name' => 'SST (45001)']);
        Standard::insert([/* id => 3 */'name' => 'Gestión de la Energía (50001)']);

        Standard::insert([/* id => 4 */'name' => 'Vehículos', 'standard_id' => 3]);
        Standard::insert([/* id => 5 */'name' => 'Generadores de gasolina', 'standard_id' => 3]);
        Standard::insert([/* id => 6 */'name' => 'Plataformas Manlif', 'standard_id' => 3]);


        // Create Relationshipt between Projects and Standards

        DB::table('project_standard')->insert([/* id => 1 */'project_id' => 1, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 2 */'project_id' => 1, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 3 */'project_id' => 1, 'standard_id' => 3]);

        DB::table('project_standard')->insert([/* id => 4 */'project_id' => 2, 'standard_id' => 1]);
        DB::table('project_standard')->insert([/* id => 5 */'project_id' => 2, 'standard_id' => 2]);
        DB::table('project_standard')->insert([/* id => 6 */'project_id' => 2, 'standard_id' => 3]);


        // Placa numbers

        DB::table('no_placas')->insert([/* id => 1 */'name' => 'placa-1']);
        DB::table('no_placas')->insert([/* id => 2 */'name' => 'placa-2']);
        DB::table('no_placas')->insert([/* id => 3 */'name' => 'placa-3']);

        // Bombas de abastecimiento

        DB::table('bombas_abastecimiento')->insert([/* id => 1 */'name' => 'bomba-1']);
        DB::table('bombas_abastecimiento')->insert([/* id => 2 */'name' => 'bomba-2']);
        DB::table('bombas_abastecimiento')->insert([/* id => 3 */'name' => 'bomba-3']);
    }
}
