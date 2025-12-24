<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class PopupRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule','array<mixed>','string>
     */
    public function rules(): array
    {
        $id = isset($this->popup->id) ? $this->popup->id : null;
        $rules = [
            'name_en' => ['required', 'max:255', 'unique:popups,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:popups,name_np,' . $id],
            'publish_date' => ['required', 'date', 'after_or_equal:today'],
            'publish_upto' => ['required', 'date', 'after:today'],
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
            'download_document' => 'Download Document',
            'publish_date' => 'Publish Date',
            'publish_upto' => 'Publish Upto',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published',
        ];
    }
}
