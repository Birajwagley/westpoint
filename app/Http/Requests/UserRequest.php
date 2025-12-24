<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $id = isset($this->user->id) ? $this->user->id : null;

        $rules = [
            'name' => ['required', 'max:255'],
            'username' => [
                'required',
                'max:255',
                'unique:users,username,' . $id,
            ],
            'email' => [
                'required',
                'max:255',
                'email',
                'unique:users,email,' . $id,
            ],
            'role_id' => ['required', 'exists:roles,id'],
            'is_active' => ['required'],
        ];

        // Conditional image upload validation for thumbnail_image
        if (!request()->has('current_thumbnail_image')) {
            $rules['thumbnail_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        // Password handling
        if ($id) {
            $rules = array_merge($rules, [
                'password' => [
                    'nullable',
                    'max:255',
                    Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                ],
                'password_confirmation' => ['nullable', 'same:password'],
            ]);
        } else {
            $rules = array_merge($rules, [
                'password' => [
                    'required',
                    Password::min(8)->letters()->mixedCase()->numbers()->symbols(),
                ],
                'password_confirmation' => ['required', 'same:password'],
            ]);
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'password_confirmation' => 'Password Confirmation',
            'is_active' => 'Is Active',
            'thumbnail_image' => 'Thumbnail Image',
        ];
    }
}
