<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $id = Auth::user()->id;

        return [
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
            'password' => [
                'max:255',
                'nullable',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'password_confirmation' => ['nullable', 'same:password'],
            'thumbnail_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:2048'],

        ];
    }
}
