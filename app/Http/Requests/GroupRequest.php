<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
        $id = isset($this->group->id) ? $this->group->id : null;

        return [
            'name' => ['required', 'max:255', 'unique:groups,name,' . $id],
            'display_order' => ['required', 'integer'],
            'is_published' => ['required'],
            'have_multi_subject' => ['required'],
        ];
    }
}
