<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules\File;
use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
        $id = isset($this->page->id) ? $this->page->id : null;

        $rules = [
            'menu_id' => [
                $id != 1 ? 'required' : '',
                'exists:menus,id'
            ],
            'title_en' => [
                'required',
                'max:255',
                'unique:pages,title_en,' . $id,
            ],
            'title_np' => ['nullable', 'max:255'],
            'short_description_en' => ['required'],
            'short_description_np' => ['nullable'],
            'description_en' => ['required'],
            'description_np' => ['nullable'],
        ];

        if (!request()->has('current_banner_image')) {
            $rules['banner_image'] = ['required', File::image()->max('20mb'), 'mimes:png,jpg,jpeg'];
        }

        return $rules;
    }
}
