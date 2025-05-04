<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pet = Pet::inRandomOrder()->first();
        $vet = User::where('role', 'vet')->inRandomOrder()->first();

        return [
            'pet_id' => $pet?->id ?? Pet::factory(),
            'veterinarian_id' => $vet?->id ?? User::factory()->create(['role' => 'vet'])->id,
            'scheduled_at' => $this->faker->dateTimeBetween('+1 day', '+1 month'),
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }
}
