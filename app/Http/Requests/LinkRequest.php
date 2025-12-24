<?php

namespace App\Http\Requests;

use App\Enum\LinkTypeEnum;
use Illuminate\Foundation\Http\FormRequest;

class LinkRequest extends FormRequest
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
        return [
            'name_en' => ['required', 'max:255'],
            'name_np' => ['nullable', 'max:255'],
            'type' => ['required'],
            'menu_id' => ['required_if:type,' . LinkTypeEnum::MENU->value],
            'url' => ['required_if:type,' . LinkTypeEnum::EXTERNALLINK->value],
            'display_order' => ['required'],
            'is_published' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name_en' > 'Name (English)',
            'name_np' > 'Name (Nepali)',
            'type' > 'Type',
            'menu_id' > 'Menu',
            'url' > 'Url',
            'display_order' > 'Display Order',
            'is_published' > 'Is Published?',
        ];
    }
}
