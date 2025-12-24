<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;


class PublicationRequest extends FormRequest
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
        // dd(request()->all());
        $rules = [
            'publication_category_id' => ['required', 'exists:publication_categories,id'],
            'published_date' => ['required', 'date', 'after_or_equal:today'],
            'author'=>['nullable','max:255'],
            'name_en' => ['required', 'max:255'],
            'name_np' => ['nullable', 'max:255'],
            'slug' => [
                'required',
                'max:255',
            ],
            'images' => 'nullable|array',
        'images.*' => 'file|mimes:png,jpg,jpeg|max:10240',
            'short_description_en'=>['required'],
            'short_description_np'=>['nullable'],
            'description_en'=>['nullable'],
            'description_np'=>['nullable'],
            'external_link'=>['nullable', 'url'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
        ];

        if (!request()->has('current_thumbnail_image')) {
            $rules['thumbnail_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }
        return $rules;
    }
}
