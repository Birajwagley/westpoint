<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label for="{{ $fieldName }}" class="block text-sm font-semibold text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <textarea id="{{ $fieldName }}" name="{{ $fieldName }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary summernote @error($fieldName) border-red-500 @enderror">{{ old($fieldName, isset($data) ? $data : null) }}</textarea>

    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
