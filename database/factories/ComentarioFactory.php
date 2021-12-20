<?php

namespace Database\Factories;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComentarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'texto' => $this->faker->paragraph(),
            'id_servicio' => Servicio::inRandomOrder()->first()->id,
            'id_usuario' => User::inRandomOrder()->first()->id
        ];
    }
}
