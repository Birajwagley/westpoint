<?php

namespace App\Http\Requests;

use App\Enum\GalleryTypeEnum;
use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class GalleryRequest extends FormRequest
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
        $id = isset($this->gallery->id) ? $this->gallery->id : null;
        $rules = [
            'type' => ['required'],
            'name_en' => ['required', 'max:255', 'unique:galleries,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:galleries,name_np,' . $id],
            'slug' => ['required', 'max:255'],
            'video_link' => ['required_if:type,' . GalleryTypeEnum::VIDEO->value],
            'display_order' => ['required'],
            'is_published' => ['required', 'boolean'],
            'is_featured' => ['required', 'boolean'],
        ];

        if (!request()->has('current_cover_image')) {
            $rules['cover_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        if ($this->type == GalleryTypeEnum::IMAGE->value) {
            if (!request()->has('current_images') || request()->current_images[0] == null) {
                $rules['images'] = 'required|array';
                $rules['images.*'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
            }
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'type' => 'Type',
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'slug' => 'Slug',
            'video_link' => 'Video Link',
            'display_order' => 'Display Order',
            'is_featured' => 'Is Featured?',
            'is_published' => 'Is Published?',
            'cover_image' => 'Cover Image',
            'images' => 'Images',
        ];
    }
}
