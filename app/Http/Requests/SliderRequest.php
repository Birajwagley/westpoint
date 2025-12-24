<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
        $id = isset($this->slider->id) ? $this->slider->id : null;
        $rules = [
            'name_en' => ['required', 'max:255', 'unique:sliders,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:sliders,name_np,' . $id],
            'link' => ['nullable', 'url'],
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
        ];

        if (!request()->has('current_image')) {
            $rules['image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'image' => 'Image',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published',
        ];
    }
}
