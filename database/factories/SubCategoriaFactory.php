<?php

namespace Database\Factories;

use App\Models\SubCategoria;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubCategoriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nombre' => $this->faker->word(),
            'id_categoria' => SubCategoria::inRandomOrder()->first()->id
        ];
    }
}
