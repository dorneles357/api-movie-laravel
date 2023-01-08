<?php

namespace Database\Factories;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;

        $name = $faker->month;

        /**
         * @TODO Continuar preenchendo o factory
         */
        return [
            'name' => $name,
        ];
    }
}
