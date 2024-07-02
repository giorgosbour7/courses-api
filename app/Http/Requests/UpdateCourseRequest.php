<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest {
    public function rules(): array {
        return [
            'title' => ['sometimes', 'required', 'string'],
            'description' => ['sometimes', 'required', 'string'],
            'status' => ['nullable', 'in:Published,Pending'],
            'is_premium' => ['sometimes', 'required', 'boolean'],
        ];
    }
}
