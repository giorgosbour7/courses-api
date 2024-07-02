<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;

Route::apiResource('courses', CourseController::class)
    ->missing(function () {
    return response()->json(['error' => 'Course not found'], 404);
});
