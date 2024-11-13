<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    protected $model = Customer::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'address' => $this->faker->address,
            'phoneNumber' => '601' . $this->faker->numberBetween(10000000, 99999999),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'birthday' => $this->faker->date('Y-m-d', '2005-12-31'), // Limiting to realistic birth years
        ];
    }
}

