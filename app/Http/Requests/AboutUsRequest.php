<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class AboutUsRequest extends FormRequest
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
            'title_en' => 'required',
            'title_en' => 'nullable',
            'description_en' => 'required',
            'description_np' => 'nullable',
            'mission_en' => 'required',
            'mission_np' => 'nullable',
            'vision_en' => 'required',
            'vision_np' => 'nullable',
        ];

        if (!request()->has('current_image_one')) {
            $rules['image_one'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_image_two')) {
            $rules['image_two'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_image_three')) {
            $rules['image_three'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'image_one' => 'Image One',
            'image_two' => 'Image Two',
            'image_three' => 'Image Three',
            'title_en' => 'Title (English)',
            'title_en' => 'Title (Nepali)',
            'description_en' => 'Description (English)',
            'description_np' => 'Description (Nepali)',
            'mission_en' => 'Mission (English)',
            'mission_np' => 'Mission (Nepali)',
            'vision_en' => 'Vision (English)',
            'vision_np' => 'Vision (Nepali)',
        ];
    }
}
