<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'category' => 'required|string|max:100',
            'price' => 'nullable|numeric|min:0|max:999999.99',
            'duration' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'instructor_name' => 'nullable|string|max:250',
            'published_at' => 'nullable|date',

            'modules' => 'required|array',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.summary' => 'nullable|string',
            'modules.*.duration' => 'nullable|string|max:100',
            'modules.*.status' => 'nullable|in:draft,published',

            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.type' => 'required|in:text,image,video,link,pdf,quiz',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.value' => 'nullable|string',
            'modules.*.contents.*.duration' => 'nullable|string|max:100',
        ];
    }
}
