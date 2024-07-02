<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseFactory extends Factory {
    protected $model = Course::class;

    public function definition(): array {
        $job_title = $this->faker->jobTitle();

        return [
            'title' => implode(' ', ['Introduction to', $job_title]),
            'description' => implode(' ', ['This course is an introduction to', $job_title]),
            'status' => $this->faker->randomElement(['Published', 'Pending']),
            'is_premium' => $this->faker->boolean(),
        ];
    }
}
