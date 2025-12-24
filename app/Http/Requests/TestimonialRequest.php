<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class TestimonialRequest extends FormRequest
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
        $rules =  [
            'alumni_from_id' => ['nullable', 'exists:alumni_form,id'],
            'full_name' => ['required'],
            'testimonial_text' => ['required'],
            'testimonial_video' => ['nullable', 'url'],
            'perspective_from' => ['required'],
            'is_featured' => ['required', 'boolean'],
        ];

        if (!request()->has('current_image')) {
            $rules['image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }
}
