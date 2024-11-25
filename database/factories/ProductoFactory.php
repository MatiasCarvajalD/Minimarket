<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductoFactory extends Factory
{
    public function definition()
    {
        return [
            'nom_producto' => $this->faker->word(),
            'marca' => $this->faker->company(),
            'descripcion' => $this->faker->sentence(),
            'precio' => $this->faker->numberBetween(100, 10000),
            'id_categoria' => 1, // Suponiendo que existe una categoría con ID 1
            'stock_actual' => $this->faker->numberBetween(10, 100),
            'stock_critico' => 5,
        ];
    }
}
