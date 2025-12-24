<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;
use TimeHunter\LaravelGoogleReCaptchaV3\Validations\GoogleReCaptchaV3ValidationRule;

class ContactUsRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'contact_no' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'email' => 'required|email|max:255',
            'message' => 'required|string|max:2000',
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function attributes()
    {
        return [
            'full_name' => __('pages.full_name'),
            'contact_no' => __('pages.contact_no'),
            'email' => __('pages.email'),
            'message' => __('pages.your_message'),
            'g-recaptcha-response' => __('pages.captcha'),
        ];
    }
}
