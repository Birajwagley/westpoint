<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PublicationCategoryRequest extends FormRequest
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
        $id = isset($this->publication_category->id) ? $this->publication_category->id : null;
        $rules = [
            'name_en' => ['required', 'max:255', 'unique:publication_categories,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:publication_categories,name_np,' . $id],
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published',
            'is_featured' => 'Is Featured',
        ];
    }
}
