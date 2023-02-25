<?php

namespace Database\Factories;

use App\Models\Movie;
use Illuminate\Database\Eloquent\Factories\Factory;

class MovieFactory extends Factory
{

    protected $movie = Movie::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'path' => $this->faker->filePath(),
            'type' => $this->faker->mimeType(),
            'size' => $this->faker->buildingNumber(),
        ];
    }
}
