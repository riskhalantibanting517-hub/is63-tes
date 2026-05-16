<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $majors = null;
        try {
            $majors = \App\Models\Major::pluck('name')->toArray();
        } catch (\Throwable $e) {
            // ignore if majors table doesn't exist yet
        }

        return [
            'nim' => $this->faker->unique()->numerify('######'),
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'major' => $this->faker->randomElement($majors ?: ['Teknik Informatika', 'Sistem Informasi', 'Manajemen', 'Akuntansi', 'Desain Grafis']),
            'address' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'birth_date' => $this->faker->dateTimeBetween('-30 years', '-18 years'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'status' => $this->faker->randomElement(['active', 'inactive', 'graduated']),
        ];
    }
}
