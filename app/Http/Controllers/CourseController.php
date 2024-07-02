<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Session\Store;
use App\Http\Requests\StoreCourseRequest;

class CourseController extends Controller {
    public function index() {
        return Course::all();
    }

    public function store(StoreCourseRequest $request) {
        return Course::create($request->validated());
    }

    public function show(Course $course) {
        return $course;
    }

    public function update(UpdateCourseRequest $request, Course $course) {
        $course->update($request->validated());

        return $course;
    }

    public function destroy(Course $course) {
        $course->delete();

        return response()->json(['error' => 'Course deleted successfully']);
    }
}
