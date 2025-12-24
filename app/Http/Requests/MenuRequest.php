<?php

namespace App\Http\Requests;

use App\Enum\MenuTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
        $id = isset($this->menu->id) ? $this->menu->id : null;

        $rules = [
            'type' => ['required'],
            'slug' => ['required_if:type,' . MenuTypeEnum::SLUG->value, 'max:255'],
            'external_link' => ['required_if:type,' . MenuTypeEnum::EXTERNAL->value],

            'parent_id' => ['nullable', 'exists:menus,id'],

            'name_en' => ['required', 'max:255', 'unique:menus,name_en,' . $id],
            'name_np' => ['nullable', 'max:255', 'unique:menus,name_np,' . $id],
            'display_order' => ['integer', 'required'],
            'is_published' => ['required', 'boolean'],
            'is_featured_navigation' => ['required', 'boolean'],
            'icon' => ['required_if:is_featured_navigation,true'],
        ];

        return $rules;
    }

    public function attributes()
    {
        return [
            'type' => 'Type',
            'slug' => 'Slug',
            'external_link' => 'External Link',
            'parent_id' => 'Parent',
            'name_en' => 'Name En',
            'name_np' => 'Name Np',
            'icon' => 'Icon',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published?',
            'is_featured_navigation' => 'Is Featured Navigation?',
        ];
    }

    public function messages()
    {
        return [
            'icon.required_if' => 'Icon field is required when Is Featured Navigation is Yes',
        ];
    }
}
