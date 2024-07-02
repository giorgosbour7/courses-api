<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CourseControllerTest extends TestCase {
    use RefreshDatabase;

    public function test_can_get_all_courses()
    {
        $courses = Course::factory()->count(3)->create();

        $response = $this->getJson('/api/courses');

        $response->assertStatus(200)
                 ->assertJsonCount(3)
                 ->assertJsonStructure([
                     '*' => ['id', 'title', 'description', 'status', 'is_premium', 'created_at', 'updated_at']
                 ]);
    }

    public function test_can_create_course()
    {
        $courseData = [
            'title' => 'New Course',
            'description' => 'Course Description',
            'status' => 'Pending',
            'is_premium' => false,
        ];

        $response = $this->postJson('/api/courses', $courseData);

        $response->assertStatus(201)
                 ->assertJsonFragment($courseData);
    }

    public function test_cannot_create_course_with_invalid_data()
    {
        $invalidData = [
            'title' => '',
            'description' => 'Valid description',
            'status' => 'InvalidStatus',
            'is_premium' => 'not_a_boolean'
        ];

        $response = $this->postJson('/api/courses', $invalidData);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['title', 'status', 'is_premium']);
    }

    public function test_can_show_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJson($course->toArray());
    }

    public function test_shows_error_if_course_not_found()
    {
        $response = $this->getJson("/api/courses/9999");

        $response->assertStatus(404)
                 ->assertJson(['error' => 'Course not found']);
    }

    public function test_can_update_course()
    {
        $course = Course::factory()->create();
        $updatedData = [
            'title' => 'Updated Course Title',
            'description' => 'Updated Course Description',
        ];

        $response = $this->putJson("/api/courses/{$course->id}", $updatedData);

        $response->assertStatus(200)
                 ->assertJsonFragment($updatedData);

        $this->assertDatabaseHas('courses', [
            'id' => $course->id,
            'title' => 'Updated Course Title',
            'description' => 'Updated Course Description',
            'status' => $course->status,
            'is_premium' => $course->is_premium,
        ]);
    }

    public function test_can_delete_course()
    {
        $course = Course::factory()->create();

        $response = $this->deleteJson("/api/courses/{$course->id}");

        $response->assertStatus(200)
                 ->assertJson(['error' => 'Course deleted successfully']);

        $this->assertSoftDeleted('courses', ['id' => $course->id]);
    }
}
