<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClassesRequest extends FormRequest
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
        $id = $this->class->id ?? null;

        $rules = [
            'name_en' => ['required', 'max:255', 'unique:classes,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:classes,name_np,' . $id],
            'icon' => 'required',
            'description_en' => 'required',
            'description_np' => 'nullable',
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
            'is_admission_allowed' => ['nullable', 'boolean'],
        ];
        return $rules;
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name En',
            'name_np' => 'Name Np',
            'icon' => 'Icon',
            'description_en' => 'Description (English)',
            'description_np' => 'Description (Nepali)',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published?',
            'is_admission_allowed' => 'Is Admission Allowed?',
        ];
    }
}
