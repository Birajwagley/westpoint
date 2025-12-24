<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
            'title_en' => ['required', 'max:255', 'string'],
            'title_np' => ['nullable', 'max:255', 'string'],
            'address_en' => ['required', 'max:255', 'string'],
            'address_np' => ['nullable', 'max:255', 'string'],
            'admission_notify_email' => ['required', 'email'],
            'career_notify_email' => ['required', 'email'],
            'volunteer_notify_email' => ['required', 'email'],
            'feedback_notify_email' => ['required', 'email'],
            'map' => ['required'],
            'facebook' => ['nullable'],
            'instagram' => ['nullable'],
            'x' => ['nullable'],
            'linkedin' => ['required'],
            'youtube' => ['required'],
            'youtube_video' => ['required'],
            'schema_markup' => ['nullable'],
            'canonical_url' => ['nullable'],
            'keyword' => ['nullable'],
            'school_hour_en' => ['nullable'],
            'school_hour_np' => ['nullable'],
            'description_en' => ['nullable'],
            'description_np' => ['nullable'],

            'name_email.*' => ['required'],
            'emails.*' => ['required'],

            'name_contact.*' => ['required'],
            'contacts.*' => ['required'],
        ];

        if (!request()->has('current_primary_logo')) {
            $rules['primary_logo'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_secondary_logo')) {
            $rules['secondary_logo'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_experience_logo')) {
            $rules['experience_logo'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_favicon')) {
            $rules['favicon'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if (!request()->has('current_school_overview_image')) {
            $rules['school_overview_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'primary_logo' => 'Primary Logo',
            'secondary_logo' => 'Secondary Logo',
            'experience_logo' => 'Experience Logo',
            'favicon' => 'Favicon',
            'current_school_overview_logo' => 'Current School Overview Image',
            'title_en' => 'Title (English)',
            'title_np' => 'Title (Nepali)',
            'address_en' => 'Address (English)',
            'address_np' => 'Address (Nepali)',
            'admission_notify_email' => 'Admission Notify Email',
            'career_notify_email' => 'Career Notify Email',
            'volunteer_notify_email' => 'Volunteer Notify Email',
            'feedback_notify_email' => 'Feedback Notify Email',
            'map' => 'Map',
            'facebook' => 'Facebook',
            'instagram' => 'Instagram',
            'x' => 'X',
            'linkedin' => 'Linkedin',
            'youtube' => 'Youtube',
            'schema_markup' => 'Schema Markup',
            'canonical_url' => 'Canonical URL',
            'keyword' => 'Keyworad',
            'school_hour_en' => 'School Hour (English)',
            'school_hour_np' => 'School Hour (Nepali)',
            'description_en' => 'Description (English)',
            'description_np' => 'Description (Nepali)',

            'name_email.*' => 'Name',
            'emails.*' => 'Email',

            'name_contact.*' => 'Name',
            'contacts.*' => 'Contact No.',

            'contacts' => 'Contact',
        ];
    }
}
