<?php

namespace Database\Seeders;

use App\Models\Movimiento;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $faker = \Faker\Factory::create('es_ES');
        $tarjetas = DB::table('tarjetas')->pluck('id');
        foreach ($tarjetas as $tarjeta) {
                Movimiento::create([
                    'tarjeta_id' => $tarjeta,
                    'cantidad' => random_int(1, 50) * 100,
                    'fecha' => '2000/01/01',
                ]);
        }        
    }
}
