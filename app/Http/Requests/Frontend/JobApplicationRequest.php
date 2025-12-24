<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class JobApplicationRequest extends FormRequest
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
            'career_id' => ['required'],
            'full_name' => ['required', 'max:255'],
            'gender' => ['required', 'in:male,female,others'],
            'other_gender' => ['required_if:gender,others'],
            'date_of_birth_ad' => ['required', 'date'],
            'date_of_birth_bs' => ['required', 'string'],
            'age' => ['required', 'max:255'],
            'current_address' => ['required', 'max:255'],
            'mobile_number' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'email' => ['required', 'email'],
            'phone_no' => ['nullable', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'highest_education_qualification' => ['required', 'max:255'],
            'cover_letter' => ['required'],
            'cv' => ['required'],
            'g-recaptcha-response' => 'required|captcha',
        ];
    }

    public function attributes()
    {
        return [
            'career_id' => __('pages.career'),
            'full_name' => __('pages.full_name'),
            'gender' => __('pages.gender'),
            'other_gender' => __('pages.specify_gender'),
            'date_of_birth_ad' => __('pages.date_of_birth_ad'),
            'date_of_birth_bs' => __('pages.date_of_birth_bs'),
            'age' => __('pages.age'),
            'current_address' => __('pages.current_address'),
            'mobile_no' => __('pages.mobile_no'),
            'email' => __('pages.email'),
            'phone_no' => __('pages.phone_no'),
            'highest_education_qualification' => __('pages.qualification'),
            'cv' => __('pages.cv'),
            'cover_letter' => __('pages.cover_letter'),
            'g-recaptcha-response' => __('pages.captcha'),
        ];
    }
}
