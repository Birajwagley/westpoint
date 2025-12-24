<?php

namespace App\Http\Requests;

use App\Enum\AwardAchivementTypeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


class AwardRecognitionRequest extends FormRequest
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
            'type' => ['required'],
            'award_type' => ['required_if:type,' . AwardAchivementTypeEnum::AWARD->value],
            'title_en' => ['required', 'max:255'],
            'title_np' => ['nullable', 'max:255'],
            'short_description_en' => ['required'],
            'short_description_np' => ['nullable'],
            'display_order' => ['required', 'min:1', 'integer'],
            'is_featured' => ['required', 'boolean'],
            'is_published' => ['required', 'boolean'],
        ];

        if (!request()->has('current_image')) {
            $rules['image'] = ['required_if:type,' . AwardAchivementTypeEnum::ACHIVEMENT->value, File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }
}
