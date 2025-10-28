<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $firstName = $this->faker->firstname;
        $lastName = $this->faker->lastName;
        $username = strtolower($firstName . '.' . $lastName . rand(1, 99));
        $email = $this->faker->unique()->safeEmail;
        $password = bcrypt('password123'); // or Hash::make('password123')
        $phoneNumber = $this->faker->phoneNumber;

        return [
            'username' => substr($username, 0, 30),
            'email' => $email,
            'password_hash' => $password,

            'first_name' => substr($firstName, 0, 30),
            'last_name' => substr($lastName, 0, 30),

            'date_of_birth' => $this->faker->date('Y-m-d', '2005-12-31'),
            'address' => fake()->address(),
            'phone_number' => $phoneNumber,


        ];
    }
}
