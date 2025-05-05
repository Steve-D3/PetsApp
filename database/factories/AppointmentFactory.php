<?php

namespace Database\Factories;

use App\Models\Pet;
use App\Models\User;
use Carbon\Carbon;
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
        $start = $this->fakeStartTime();
        $end = (clone $start)->addMinutes(30);

        return [
            'pet_id' => Pet::inRandomOrder()->first()?->id ?? Pet::factory(),
            'veterinarian_id' => User::where('role', 'vet')->inRandomOrder()->first()?->id ?? User::factory(),
            'start_time' => $start,
            'end_time' => $end,
            'status' => $this->faker->randomElement(['pending', 'confirmed', 'cancelled', 'completed']),
            'notes' => $this->faker->optional()->sentence(),
        ];
    }

    private function fakeStartTime(): Carbon
    {
        $date = Carbon::today()->addDays(rand(1, 10)); // upcoming 10 days
        $hour = rand(9, 16); // last slot at 16:30
        $minute = $this->faker->randomElement([0, 30]);
        return Carbon::createFromTime($hour, $minute)->setDateFrom($date);
    }
}
