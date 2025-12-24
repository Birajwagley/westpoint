<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class TeamsRequest extends FormRequest
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
        $id = isset($this->team->id) ? $this->team->id : null;
        $rules = [
            'name_en' => ['required', 'max:255', 'unique:teams,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:teams,name_en,' . $id],
            'mobile_number' => ['nullable'],
            'email' => ['nullable', 'email'],
            'department_id' => ['required', 'exists:departments,id'],
            'designation_id' => ['required', 'exists:designations,id'],
            'description_en' => ['nullable'],
            'description_np' => ['nullable'],
            'facebook' => ['nullable'],
            'linked_in' => ['nullable'],
            'type' => ['required'],
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
        ];

        if (!request()->has('current_image')) {
            $rules['image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }
        return $rules;
    }
}
