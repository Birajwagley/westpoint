<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FacultyGroupSubjectRequest extends FormRequest
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
            'group_id.*' => 'required',
        ];

        foreach ($this->subject_id as $key => $value) {

            // For first 5 rows → required
            if ($key < 5) {
                $rules["subject_id.$key"] = ['required', 'exists:subjects,id'];
            }

            // Others → nullable
            else {
                $rules["subject_id.$key"] = ['nullable'];
            }
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'subject_id.*' => 'Subject',
        ];
    }
}
