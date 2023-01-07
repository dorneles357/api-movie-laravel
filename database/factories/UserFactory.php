<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * @return array
     */
    public function definition()
    {
        $faker = $this->faker;

        $name = $faker->name;

        /**
         * @TODO Continuar preenchendo o factory
         */
        return [
            'name' => $name,
            'email' => $faker->email,
            'password' => 'abc@123'
        ];
    }
}
