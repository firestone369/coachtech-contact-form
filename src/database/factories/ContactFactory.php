<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'last_name'   => $this->faker->lastName,
            'first_name'  => $this->faker->firstName,
            'gender'      => $this->faker->randomElement([1, 2, 3]),
            'email'       => $this->faker->unique()->safeEmail,
            'tel'         => '09012345678',
            'address'     => $this->faker->address,
            'building'    => $this->faker->optional()->secondaryAddress,
            'category_id' => $this->faker->numberBetween(1, 5),
            'detail'      => $this->faker->sentence,
        ];
    }
}
