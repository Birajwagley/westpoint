<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
        $id = isset($this->subscription->id) ? $this->subscription->id : null;

        return [
            'email' => 'required|email|unique:subscriptions,email,' . $id,
            'is_active' => 'nullable|boolean',
        ];
    }

    public function attributes()
    {
        return [
            'email' => 'Email',
            'is_active' => 'Is Active?',
        ];
    }
}
