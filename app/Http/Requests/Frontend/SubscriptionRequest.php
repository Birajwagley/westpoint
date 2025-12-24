<?php

namespace App\Http\Requests\Frontend;

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
        return [
            'email' => 'required|email|unique:subscriptions,email',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('pages.email'),
            'g-recaptcha-response' => __('pages.captcha'),
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => __('pages.news_letter_email_unique'),
        ];
    }

    protected function getRedirectUrl()
    {
        $url = url()->previous();
        return $url . '#footer-section';
    }
}
