<?php

namespace Database\Factories;

use App\Models\Servicio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'precio' => $this->faker->randomFloat(2, 0, 10000),
            //'imagen' => $this->faker->randomElement(['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg']),
            'id_servicio' => Servicio::inRandomOrder()->first()->id,
            'id_usuario' => User::inRandomOrder()->first()->id
        ];
    }
}
