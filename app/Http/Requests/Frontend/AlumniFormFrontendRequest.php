<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class AlumniFormFrontendRequest extends FormRequest
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
        $rules = [
            'full_name' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'mobile_number' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'occupation' => ['required'],
            'designation' => ['required', 'max:255'],
            'batch' => ['required', 'max:255'],
            'country' => ['required'],
            'section_type' => ['nullable'],
            'testimonial_text' => ['required'],
            'testimonial_video' => ['nullable'],
            'is_published' => ['nullable', 'boolean'],
            'g-recaptcha-response' => 'required|captcha',
        ];

        if (!request()->has('current_image  ')) {
            $rules['image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_company_logo')) {
            $rules['company_logo'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'full_name' => 'Full Name',
            'image' => 'Image',
            'email' => 'Email',
            'mobile_number' => 'Mobile Number',
            'occupation' => 'Occupation',
            'address' => 'Address',
            'testimonial_text' => 'Testimonial',
            'testimonial_video' => 'Testimonial (Video Url)',
            'is_published' => 'Is Published',
        ];
    }
}
