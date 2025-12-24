<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class AboutUsCardRequest extends FormRequest
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
            'card_name_en.*' => 'required',
            'card_name_np.*' => 'nullable',
            'card_link.*' => 'required',
            'card_short_description_en.*' => 'required',
            'card_short_description_np.*' => 'nullable',
        ];

        $currentImages = $this->input('current_image', []);
        foreach ($currentImages as $index => $image) {
            if (empty($currentImages[$index])) {
                $rules["card_image.$index"] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
            } else {
                $rules["card_image.$index"] = ['nullable', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
            }
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'card_name_en.*' => 'Name (English)',
            'card_name_en.*' => 'Name (Nepali)',
            'card_link.*' => 'Link',
            'card_image.*' => 'Image',
            'card_short_description_en.*' => 'Short Description (English)',
            'card_short_description_np.*' => 'Short Description (Nepali)',
        ];
    }
}
