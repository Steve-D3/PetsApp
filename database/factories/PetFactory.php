<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $species = $this->faker->randomElement(['Dog', 'Cat', 'Rabbit', 'Bird']);
        $breeds = [
            'Dog' => ['Labrador', 'Poodle', 'Bulldog'],
            'Cat' => ['Siamese', 'Persian', 'Maine Coon'],
            'Rabbit' => ['Lionhead', 'Dutch', 'Mini Rex'],
            'Bird' => ['Parrot', 'Canary', 'Cockatiel'],
        ];

        $weightRanges = [
            'Dog' => [5, 40],
            'Cat' => [3, 8],
            'Rabbit' => [1, 3],
            'Bird' => [0.05, 1],
        ];

        $photos = [
            'cat' => 'https://petsastherapy.org/images/uploads/cutouts/Cats_for_website_2.0_copy_.png',
            'dog' => 'https://cdn.pixabay.com/photo/2023/08/18/15/02/dog-8198719_1280.jpg',
            'rabbit' => 'https://upload.wikimedia.org/wikipedia/commons/1/1f/Oryctolagus_cuniculus_Rcdo.jpg',
            'bird' => 'https://media.newyorker.com/photos/5a95a5b13d9089123c9fdb7e/master/w_2560%2Cc_limit/Petrusich-Dont-Mess-with-the-Birds.jpg',
        ];

        return [
            'user_id' => User::inRandomOrder()->first()->id, // Assumes users already seeded
            'name' => $this->faker->firstName(),
            'photo' => $photos[strtolower($species)],
            'microchip_number' => $this->faker->optional()->regexify('[A-Z0-9]{10}'), //in the future the microchip will contain the owner information
            'sterilized' => $this->faker->boolean(70),
            'species' => $species,
            'breed' => $this->faker->randomElement($breeds[$species]),
            'gender' => $this->faker->randomElement(['Male', 'Female']),
            'weight' => $this->faker->randomFloat(2, $weightRanges[$species][0], $weightRanges[$species][1]),
            'birth_date' => $this->faker->dateTimeBetween('-10 years', '-3 months')->format('Y-m-d'),
            'allergies' => $this->faker->optional()->words(2, true),
            'food_preferences' => $this->faker->optional()->sentence(),
        ];
    }
}
