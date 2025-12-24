<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'nullable|exists:job_categories,id',
            'location' => 'nullable|string|max:255',
            'salary_range' => 'nullable|string|max:255',
            'experience_level' => 'nullable|string|max:255',
            'status' => 'nullable|in:open,closed,archived',
        ];
    }
}
