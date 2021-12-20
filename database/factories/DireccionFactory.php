<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DireccionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $provincias = ['Alicante', 'Murcia', 'Málaga', 'Lugo', 'Asturias', 'Almeria', 'Badajoz', 'Cáceres', 'Huesca', 'Sevilla', 'Huelva', 'León'];
        return [
            'codigo_postal' => '45214',
            'pais' => $this->faker->country(),
            'provincia' => $provincias[mt_rand(0, count($provincias) - 1)],
            'domicilio' => $this->faker->address(),
            'ciudad' => $this->faker->city(),
            'id_usuario' => User::inRandomOrder()->first()->id

        ];
    }
}
