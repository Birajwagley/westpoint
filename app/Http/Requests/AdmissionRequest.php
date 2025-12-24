<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = [
            'photo'             => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'first_name'        => 'required|string|max:255',
            'middle_name'       => 'nullable|string|max:255',
            'last_name'         => 'required|string|max:255',
            'email'             => 'required|email|max:255',
            'dob_bs'            => 'required|string|max:20',
            'dob_ad'            => 'required|date',
            'age'               => 'required|numeric|min:1|max:150',
            'gender'            => ['required', Rule::in(['male', 'female', 'others'])],
            'other_gender'      => 'required_if:gender,others|nullable|string|max:255',

            'permanent_address' => 'required|string|max:255',
            'current_address'   => 'required|string|max:255',
            'nationality'       => 'required|string|max:255',
            'contact_no'        => 'required|regex:/^(\+977)?9[78][0-9]{8}$/',

            'academic_year'             => 'required|string|max:20',
            'previous_school'           => 'required|string|max:255',
            'previous_school_address'    => 'required|string|max:255',
            'academic_level_id'         => 'required|exists:academic_levels,id',

            'living_with_guardian' => 'required|boolean',

            // Must contain at least 2 items (Father, Mother)
            'parents' => 'required|array|min:2',

            // Basic structure for all parents
            'parents.*.name'       => 'nullable|string|max:255',
            'parents.*.relation'   => 'nullable|string|max:100',
            'parents.*.occupation' => 'nullable|string|max:255',
            'parents.*.contact_no' => [
                'nullable',
                'regex:/^(\+977)?9[78][0-9]{8}$/',
            ],

            // FATHER (Index 0)
            'parents.0.relation'   => ['required', Rule::in(['Father'])],
            'parents.0.name'       => 'required|string|max:255',
            'parents.0.occupation' => 'required|string|max:255',
            'parents.0.contact_no' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],

            // MOTHER (Index 1)
            'parents.1.relation'   => ['required', Rule::in(['Mother'])],
            'parents.1.name'       => 'required|string|max:255',
            'parents.1.occupation' => 'required|string|max:255',
            'parents.1.contact_no' => ['required', 'regex:/^(\+977)?9[78][0-9]{8}$/'],

            'is_school'         => 'required|boolean',

            'pick_drop_facility_needed' => 'required|boolean',
            'pick_drop_location'        => 'required_if:pick_drop_facility_needed,1|nullable|string|max:255',

            'approval'          => 'nullable|string|max:255',
        ];

        // Dynamic Guardian Validation
        if ($this->input('living_with_guardian')) {
            foreach ($this->input('parents', []) as $index => $parent) {
                if ($index >= 2) {
                    $rules["parents.$index.relation"]   = 'required|string|max:100';
                    $rules["parents.$index.name"]       = 'required|string|max:255';
                    $rules["parents.$index.occupation"] = 'required|string|max:255';
                    $rules["parents.$index.contact_no"] = [
                        'required',
                        'regex:/^(\+977)?9[78][0-9]{8}$/',
                    ];
                }
            }
        }

        $rules['admission_type'] = 'required_if:is_school,1|nullable|max:255';
        $rules['class_id']       = 'required_if:is_school,1|nullable|exists:classes,id';
        $rules['last_class_id']  = 'required_if:is_school,1|nullable|exists:classes,id';

        $rules['faculty_id'] = 'required_if:is_school,0|nullable|exists:faculties,id';
        $rules['gpa']        = 'required_if:is_school,0|nullable|string';
        $rules['board']      = 'required_if:is_school,0|nullable|string|max:255';
        $rules['subjects']   = 'required_if:is_school,0|nullable|array|min:6';
        $rules['subjects.*'] = 'required_if:is_school,0|nullable|exists:subjects,id';

        return $rules;
    }

    public function attributes()
    {
        return [
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'photo' => 'Photo',
            'dob_bs' => 'Date of Birth (BS)',
            'dob_ad' => 'Date of Birth (AD)',
            'age' => 'Age',
            'gender' => 'Gender',
            'other_gender' => 'Other',
            'permanent_address' => 'Permanent Address',
            'current_address' => 'Current Address',
            'nationality' => 'Nationality',
            'contact_no' => 'Contact No.',
            'academic_year' => 'Academic Year',
            'previous_school' => 'Previous School',
            'previous_school_address' => 'Previous School Address',
            'pick_drop_facility_needed' => 'Pickup & Drop Facility Needed',
            'pick_drop_location' => 'Pick & Drop Location',
            'academic_level_id' => 'Academic Year',
            'is_school' => 'Apply For',
            'approval' => 'Approval',
            'living_with_guardian' => 'Living With Guardian',
            'living_with_guardian' => 'Living With Guardian',

            'parents.0.name' => 'Father Name',
            'parents.0.relation' => 'Relation',
            'parents.0.occupation' => 'Occupation',
            'parents.0.contact_no' => 'Contact No.',

            'parents.1.name' => 'Mother Name',
            'parents.1.relation' => 'Relation',
            'parents.1.occupation' => 'Occupation',
            'parents.1.contact_no' => 'Contact No.',

            'parents.*.name' => 'Guardian Name',
            'parents.*.relation' => 'Relation',
            'parents.*.occupation' => 'Occupation',
            'parents.*.contact_no' => 'Contact No.',

            'admission_type' => 'Admission Type',
            'class_id' => 'Class',
            'last_class_id' => 'Last Class',

            'faculty_id' => 'Faculty',
            'gpa' => 'GPA',
            'board' => 'Board',

            'subjects.*' => 'Subject',
            'g-recaptcha-response' => 'required|captcha',

        ];
    }

    public function messages(): array
    {
        $messages = [
            'parents.required' => 'Father and Mother information is required.',
            'parents.min'      => 'At least Father and Mother must be added.',

            'parents.0.relation.in' => 'The first parent must be Father.',
            'parents.1.relation.in' => 'The second parent must be Mother.',
            'g-recaptcha-response' => __('pages.captcha'),

        ];

        // Dynamic guardian messages
        if ($this->input('living_with_guardian')) {
            foreach ($this->input('parents', []) as $index => $parent) {
                if ($index >= 2) {

                    $messages["parents.$index.relation.required"] = "Guardian relation is required when living with guardian is selected.";
                    $messages["parents.$index.name.required"] = "Guardian name is required when living with guardian is selected.";
                    $messages["parents.$index.occupation.required"] = "Guardian occupation is required when living with guardian is selected.";
                    $messages["parents.$index.contact_no.required"] = "Guardian contact number is required when living with guardian is selected.";
                }
            }
        }

        $messages['admission_type.required_if'] = 'Admission type is required for school students.';
        $messages['class_id.required_if']       = 'Class is required for school admission.';
        $messages['last_class_id.required_if']       = 'Last Class is required for school admission.';

        $messages['faculty_id.required_if'] = 'Faculty is required for college students.';
        $messages['gpa.required_if']        = 'GPA is required for college admission.';
        $messages['board.required_if']      = 'Board is required for college admission.';

        $messages['subjects.*.required_if'] = 'Subjects is as required field.';
        $messages['subjects.min']         = 'You must select at least 6 subjects.';

        return $messages;
    }
}
