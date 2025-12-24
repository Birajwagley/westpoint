<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $id = isset($this->role->id) ? $this->role->id : null;

        return [
            'name' => 'required|string|max:225|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'permissions' => 'Premission',
        ];
    }

    public function messages()
    {
        return [
            'permissions.required' => 'You must assign atleaset one permission to this role.',
        ];
    }
}
