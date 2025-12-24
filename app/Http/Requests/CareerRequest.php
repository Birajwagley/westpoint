<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CareerRequest extends FormRequest
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
        $id = isset($this->career->id) ? $this->career->id : null;

        return [
            'slug' => ['required', 'max:255', 'unique:careers,slug,' . $id],
            'name_en' => ['required', 'max:255','unique:careers,name_en,' . $id],
            'name_np' => ['nullable', 'max:255','unique:careers,name_en,' . $id],
            'designation_id' => ['required', 'exists:designations,id'],
            'number_of_post' => ['required', 'integer', 'min:1'],
            'valid_date' => ['required', 'date', 'after_or_equal:today'],
            'requirement_en' => ['nullable'],
            'requirement_np' => ['nullable'],
            'display_order' => ['required', 'integer'],
            'is_published' => ['required', 'boolean'],
        ];
    }
}
