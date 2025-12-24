<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700" for="{{ $fieldName }}">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <input type="password" id="{{ $fieldName }}" name="{{ $fieldName }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($fieldName) border-red-500 @enderror">

    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
