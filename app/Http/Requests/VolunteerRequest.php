<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class VolunteerRequest extends FormRequest
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
        // dd($this->all());
        $rules = [
            'qualification_en' => ['required'],
            'qualification_np' => ['nullable'],
            'need_of_volunteer_en' => ['required'],
            'need_of_volunteer_np' => ['nullable'],
            'description_en' => ['required'],
            'description_np' => ['nullable'],
        ];

        if (!request()->has('current_images') || request()->current_images[0] == null) {
            $rules['images'] = ['required', 'array', 'min:1', 'max:2'];
            $rules['images.*'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        } elseif (count(request()->current_images) >= 2) {
            // Already 2 images → block new uploads
            $rules['images'] = ['prohibited'];
        } else {
            // Has 1 image → allow uploading up to 1 more
            $remaining = 1 - count(request()->current_images);
            $rules['images'] = ['nullable', 'array', 'max:' . $remaining];
            $rules['images.*'] = [File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'images.max' => 'Please upload exactly 2 images.',
        ];
    }
}
