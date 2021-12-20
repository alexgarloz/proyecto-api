<?php

namespace Database\Factories;

use App\Models\SubCategoria;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServicioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->sentence(4),
            'descripcion' => $this->faker->text(),
            'imagen' => $this->faker->randomElement(['img1.jpg', 'img2.jpg', 'img3.jpg', 'img4.jpg']),
            'precio' => $this->faker->randomFloat(2, 0, 10000),
            'id_sub_categoria' => SubCategoria::inRandomOrder()->first()->id,
            'id_usuario' => User::inRandomOrder()->first()->id
        ];
    }
}
