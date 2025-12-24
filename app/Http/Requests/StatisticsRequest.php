<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class StatisticsRequest extends FormRequest
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
            'name_en' => 'required',
            'name_np' => 'nullable',
            'icon' => 'required',
            'display_order' => 'required',
            'is_published' => 'required|boolean',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'icon' => 'Icon',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published',
        ];
    }
}
