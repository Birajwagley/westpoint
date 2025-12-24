<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends FormRequest
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
        $id = isset($this->subject->id) ? $this->subject->id : null;

        return [
            'name_en' => ['required', 'unique:subjects,id,' . $id],
            'name_np' => ['nullable'],
            'display_order' => ['required'],
            'is_published' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published?',
        ];
    }
}
