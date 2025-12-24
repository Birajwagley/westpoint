<?php

namespace App\Http\Requests;

use App\Enum\DrawerNavigationType;
use Illuminate\Foundation\Http\FormRequest;

class DrawerNavigationRequest extends FormRequest
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
            'name_en' => ['required'],
            'name_np' => ['nullable'],
            'icon' => ['required'],
            'type' => ['required'],
            'menu_id' => ['required_if:type,' . DrawerNavigationType::MENU->value],
            'value' => ['required_if:type,' . DrawerNavigationType::EXTERNALLINK->value, 'required_if:type,' . DrawerNavigationType::TEL->value],
            'display_order' => ['required'],
            'is_published' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'name_en' => 'Name (English)',
            'name_np' => 'Name (Nepali)',
            'icon' => 'Icon',
            'type' => 'Type',
            'menu_id' => 'Menu',
            'value' => 'Value',
            'display_order' => 'Display Order',
            'is_published' => 'Is Published?',
        ];
    }
}
