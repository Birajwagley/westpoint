<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AlumniFormRequest extends FormRequest
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
            'is_published' => ['required', 'boolean'],
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'full_name' => 'Full Name',
            'email' => 'Email',
            'mobile_number' => 'Mobile Number',
            'occupation' => 'Occupation',
            'address' => 'Address',
            'perspective' => 'Perspective',
            'is_published' => 'Is Published',
        ];
    }
}
