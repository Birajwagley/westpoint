<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700 mb-1">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <div class="flex space-x-6 mt-1">
        <label class="inline-flex items-center">
            <input type="radio" name="{{ $fieldName }}" value="1"
                class="form-radio text-primary focus:ring-secondary"
                {{ old($fieldName, isset($data) ? $data : '') == 1 ? 'checked' : 'checked' }}>
            <span class="ml-2 text-gray-700">{{ __('pages.yes') }}</span>
        </label>

        <label class="inline-flex items-center">
            <input type="radio" name="{{ $fieldName }}" value="0"
                class="form-radio text-primary focus:ring-secondary"
                {{ old($fieldName, isset($data) ? $data : '') == 0 ? 'checked' : '' }}>
            <span class="ml-2 text-gray-700">{{ __('pages.no') }}</span>
        </label>
    </div>
</div>
