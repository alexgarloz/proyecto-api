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
        \App\Models\Tipo::factory(1000)->create();
        \App\Models\Direccion::factory(1000)->create();
        \App\Models\Categoria::factory(1000)->create();
        \App\Models\SubCategoria::factory(1000)->create();
        \App\Models\Servicio::factory(1000)->create();
        \App\Models\Comentario::factory(1000)->create();
        \App\Models\ContratoServicio::factory(1000)->create();
    }
}
