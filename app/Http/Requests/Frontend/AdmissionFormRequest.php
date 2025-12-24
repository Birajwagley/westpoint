<?php

namespace App\Http\Requests\Frontend;

use Illuminate\Validation\Rule;

use Illuminate\Foundation\Http\FormRequest;

class AdmissionFormRequest extends FormRequest
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

            'approval'          => 'required|boolean',
            'g-recaptcha-response' => 'required|captcha',

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
            'first_name' => __('pages.first_name'),
            'middle_name' => __('pages.middle_name'),
            'last_name' => __('pages.last_name'),
            'email' => __('pages.email'),
            'photo' => __('pages.photo'),
            'dob_bs' => __('pages.date_of_birth_bs'),
            'dob_ad' => __('pages.date_of_birth_ad'),
            'age' => __('pages.age'),
            'gender' => __('pages.gender'),
            'other_gender' => __('pages.specify_gender'),
            'permanent_address' => __('pages.permanent_address'),
            'current_address' => __('pages.current_address'),
            'nationality' => __('pages.nationality'),
            'contact_no' => __('pages.contact_no'),
            'academic_year' => __('pages.academic_year'),
            'previous_school' => __('pages.previous_school'),
            'previous_school_address' => __('pages.previous_school_address'),
            'pick_drop_facility_needed' => __('pages.pick_drop_facility_needed'),
            'pick_drop_location' => __('pages.pick_drop_location'),
            'academic_level_id' => __('pages.academic_level'),
            'is_school' => __('pages.apply_for'),
            'approval' => __('pages.approval'),
            'living_with_guardian' => __('pages.living_with_guardian'),

            'parents.0.name' => __('pages.father_name'),
            'parents.0.relation' => __('pages.relation'),
            'parents.0.occupation' => __('pages.occupation'),
            'parents.0.contact_no' => __('pages.contact_no'),

            'parents.1.name' => __('pages.mother_name'),
            'parents.1.relation' => __('pages.relation'),
            'parents.1.occupation' => __('pages.occupation'),
            'parents.1.contact_no' => __('pages.contact_no'),

            'parents.*.name' => __('pages.guardian_name'),
            'parents.*.relation' => __('pages.relation'),
            'parents.*.occupation' => __('pages.occupation'),
            'parents.*.contact_no' => __('pages.contact_no'),

            'admission_type' => __('pages.admission_type'),
            'class_id' => __('pages.class'),
            'last_class_id' => __('pages.last_class'),

            'faculty_id' => __('pages.faculty'),
            'gpa' => __('pages.gpa'),
            'board' => __('pages.board'),

            'subjects.*' => __('pages.subject'),
            'g-recaptcha-response' => __('pages.captcha'),
        ];
    }

    public function messages(): array
    {
        $messages = [
            'parents.required' => __('pages.parents'),
            'parents.min'      => __('pages.parents_min'),
            'parents.0.relation.in' => __('pages.father'),
            'parents.1.relation.in' => __('pages.mother'),
            'g-recaptcha-response.required' => __('pages.captcha'),
            'admission_type.required_if' => __('pages.admission_type'),
            'class_id.required_if'       => __('pages.class'),
            'last_class_id.required_if'  => __('pages.last_class'),
            'faculty_id.required_if'     => __('pages.faculty'),
            'gpa.required_if'            => __('pages.gpa'),
            'board.required_if'          => __('pages.board'),
            'subjects.*.required_if'     => __('pages.subjects'),
            'subjects.min'               => __('pages.subjects_min'),
        ];

        if ($this->input('living_with_guardian')) {
            foreach ($this->input('parents', []) as $index => $parent) {
                if ($index >= 2) {
                    $messages["parents.$index.relation.required"]   = __('pages.guardian');
                    $messages["parents.$index.name.required"]       = __('pages.name');
                    $messages["parents.$index.occupation.required"] = __('pages.occupation');
                    $messages["parents.$index.contact_no.required"] = __('pages.contact');
                }
            }
        }

        return $messages;
    }
}
