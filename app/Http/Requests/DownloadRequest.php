<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadRequest extends FormRequest
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
            'download_category_id' => ['required', 'exists:download_categories,id'],
            'name_en' => ['required', 'max:255'],
            'name_np' => ['nullable', 'max:255'],
            'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx|max:10240',
            'display_order' => ['required', 'min:1', 'integer'],
            'is_published' => ['required', 'boolean'],
        ];
        return $rules;
    }
}
