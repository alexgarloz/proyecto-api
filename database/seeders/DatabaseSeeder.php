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
        \App\Models\User::factory(10)->create();
        \App\Models\Tipo::factory(10)->create();
        \App\Models\Direccion::factory(10)->create();
        \App\Models\Categoria::factory(10)->create();
        \App\Models\SubCategoria::factory(10)->create();
        \App\Models\Servicio::factory(10)->create();
        \App\Models\Comentario::factory(10)->create();
        \App\Models\ContratoServicio::factory(10)->create();
    }
}
