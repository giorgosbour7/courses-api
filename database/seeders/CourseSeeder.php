<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder {
    public function run(): void {
        Course::factory()->count(50)->create();
    }
}
