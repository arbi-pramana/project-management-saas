<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Client::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'company' => $this->faker->company,
            'country' => $this->faker->country,
            'address' => $this->faker->address,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'create_by' => 1,
        ];
    }
}
