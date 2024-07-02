<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest {
    public function rules(): array {
        return [
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'status' => ['required', 'in:Published,Pending'],
            'is_premium' => ['required', 'boolean'],
        ];
    }
}
