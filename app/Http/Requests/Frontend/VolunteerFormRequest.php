<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Foundation\Http\FormRequest;

class VolunteerFormRequest extends FormRequest
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
            'date_of_birth_ad' => ['required', 'date'],
            'date_of_birth_bs' => ['required', 'string'],
            'age' => ['required', 'max:255'],
            'gender' => ['required', 'in:male,female,others'],
            'other_gender' => ['required_if:gender,others'],
            'nationality' => ['required', 'max:255'],
            'passport_number' => ['nullable'],
            'email' => ['required', 'email'],
            'contact_no' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'current_address' => ['required', 'max:255'],
            'emergency_full_name' => ['required', 'max:255'],
            'emergency_relationship' => ['required', 'max:255'],
            'emergency_contact_number' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],
            'emergency_email' => ['required', 'email'],
            'area_of_interest' => ['required'],
            'skill_experties' => ['required'],
            'motivation' => ['required'],
            'previous_volunteer_experience' => ['required'],
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after:today'],
            'daily_availability' => ['required'],
            'accomodation_required' => ['required', 'boolean'],
            'dietary_restriction' => ['nullable'],
            'medical_condition' => ['required', 'boolean'],
            'medical_description' => ['required_if:medical_condition,1'],
            'travel_insurance' => ['required', 'boolean'],
            'criminal_record' => ['required', 'boolean'],
            'aggrement' => ['required', 'boolean'],
            'cv' => ['required'],
            'insurance_proof' => ['required'],
            'passport_copy' => ['required'],
            'visa_copy' => ['required'],
            'digital_signature' => ['required'],
            'g-recaptcha-response' => 'required|captcha',
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'full_name' => __('pages.full_name'),
            'date_of_birth_ad' => __('pages.date_of_birth_ad'),
            'date_of_birth_bs' => __('pages.date_of_birth_bs'),
            'age' => __('pages.age'),
            'gender' => __('pages.gender'),
            'other_gender' => __('pages.specify_gender'),
            'nationality' => __('pages.nationality'),
            'passport_number' => __('pages.passport_no'),
            'email' => __('pages.email'),
            'contact_no' => __('pages.contact_no'),
            'current_address' => __('pages.current_address'),
            'emergency_full_name' => __('pages.full_name'),
            'emergency_relationship' => __('pages.relationship'),
            'emergency_contact_number' => __('pages.contact_no'),
            'emergency_email' => __('pages.email'),
            'area_of_interest' => __('pages.area_of_interest'),
            'skill_experties' => __('pages.skill_experties'),
            'motivation' => __('pages.motivation'),
            'previous_volunteer_experience' => __('pages.volunteer_experience'),
            'start_date' => __('pages.start_date'),
            'end_date' => __('pages.end_date'),
            'daily_availability' => __('pages.daily_availability'),
            'accomodation_required' => __('pages.accomodation_required'),
            'dietary_restriction' => __('pages.dietary_restriction'),
            'medical_condition' => __('pages.medical_condition'),
            'medical_description' => __('pages.medical_description'),
            'travel_insurance' => __('pages.travel_insurance'),
            'criminal_record' => __('pages.criminal_record'),
            'aggrement' => __('pages.aggrement'),
            'cv' => __('pages.cv'),
            'insurance_proof' => __('pages.insurance_proof'),
            'passport_copy' => __('pages.passport_copy'),
            'visa_copy' => __('pages.visa_copy'),
            'digital_signature' => __('pages.digital_signature'),
            'g-recaptcha-response' => __('pages.captcha'),
        ];
    }
}
