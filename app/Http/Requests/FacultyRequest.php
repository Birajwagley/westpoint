<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class FacultyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
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

        $rules = [
            'name_en' => ['required', 'max:255'],
            'name_np' => ['nullable', 'max:255'],
            'images' => 'nullable|array',
            'images.*' => 'file|mimes:png,jpg,jpeg|max:10240',
            'short_description_en' => ['nullable'],
            'short_description_np' => ['nullable'],
            'description_en' => ['nullable'],
            'description_np' => ['nullable'],
            'is_featured' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
            'display_order' => ['required', 'min:1', 'integer'],
        ];

        if (!request()->has('current_thumbnail_image')) {
            $rules['thumbnail_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }
}
