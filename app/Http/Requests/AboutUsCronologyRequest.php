<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutUsCronologyRequest extends FormRequest
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
            'cronology_name_en.*' => 'required',
            'cronology_name_np.*' => 'nullable',
            'cronology_date_en.*' => 'required|digits:4',
            'cronology_date_np.*' => 'required|digits:4',
            'cronology_short_description_en.*' => 'required',
            'cronology_short_description_np.*' => 'nullable',
            'cronology_description_en.*' => 'required',
            'cronology_description_np.*' => 'nullable',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'cronology_name_en.*' => 'Name (English)',
            'cronology_name_en.*' => 'Name (Nepali)',
            'cronology_date_en.*' => 'Year (A.D.)',
            'cronology_date_np.*' => 'Year (B.S.)',
            'cronology_short_description_en.*' => 'Short Description (English)',
            'cronology_short_description_np.*' => 'Short Description (Nepali)',
            'cronology_description_en.*' => 'Description (English)',
            'cronology_description_np.*' => 'Description (Nepali)',
        ];
    }
}
