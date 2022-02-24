<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(1000)->create();
        \App\Models\Tipo::factory(10)->create();
        \App\Models\Direccion::factory(1000)->create();
        \App\Models\Categoria::factory(30)->create();
        \App\Models\SubCategoria::factory(50)->create();
        \App\Models\Servicio::factory(300)->create();
        \App\Models\Comentario::factory(1000)->create();
        \App\Models\ContratoServicio::factory(280)->create();
    }
}
