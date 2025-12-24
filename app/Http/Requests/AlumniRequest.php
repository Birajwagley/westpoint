<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class AlumniRequest extends FormRequest
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
            'description_en' => ['required'],
            'description_np' => ['nullable'],
            'group_en' => ['nullable'],
            'group_np' => ['nullable'],
            'link_name.*' => ['nullable', 'max:255'],
            'link_name' => ['nullable', 'array'],
            'links.*' => ['nullable', 'url'],
            'links' => ['nullable', 'array'],
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
            'images.max' => 'You can upload a maximum of 2 images.',
        ];
    }
}
