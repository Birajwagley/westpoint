<?php

namespace App\Http\Requests;

use App\Enum\MessageFromTypeEnum;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class MessageFromRequest extends FormRequest
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
        $rules =  [
            'name' => ['required'],
            'designation_id' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'date_of_birth' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'correspondaence_address' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'permanent_address' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'country_visited' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'external_link' => ['nullable'],
            'educational_qualification' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'awards' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'seminar' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'experience' => ['required_if:slug,' . MessageFromTypeEnum::INDIRAYAKTHUMBA->value],
            'description' => ['nullable'],
        ];

        if (request()->type == 'en' && !request()->has('current_image')) {
            $rules['image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'Name',
            'image' => 'Photo',
            'designation_id' => 'Designation',
            'date_of_birth' => 'Date of Birth',
            'correspondaence_address' => 'Correspondance Address',
            'permanent_address' => 'Permanent Address',
            'country_visited' => 'Countries Visited',
            'external_link' => 'External Link',
            'educational_qualification' => 'Educational Qualification',
            'awards' => 'Awards',
            'seminar' => 'Seminar',
            'experience' => 'Experience',
            'description' => 'Description',
        ];
    }

    public function messages()
    {
        return [
            'required_if' => ':attribute is required.',
        ];
    }
}
