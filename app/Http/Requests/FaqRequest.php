<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FaqRequest extends FormRequest
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
            'faq_category_id' => ['required', 'exists:faq_categories,id'],
            'question_en' => ['required', 'max:255'],
            'question_np' => ['nullable', 'max:255'],
            'answer_en' => ['required', 'max:255'],
            'answer_np' => ['nullable', 'max:255'],
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
        ];
        return $rules;
    }
}
