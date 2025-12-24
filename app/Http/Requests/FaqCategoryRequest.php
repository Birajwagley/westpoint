<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqCategoryRequest extends FormRequest
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
        $id = $this->faq_category->id ?? null;

        $rules = [
            'name_en' => ['required', 'max:255', 'unique:faq_categories,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:faq_categories,name_np,' . $id],
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name En',
            'name_np' => 'Name Np',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published?',
        ];
    }
}
