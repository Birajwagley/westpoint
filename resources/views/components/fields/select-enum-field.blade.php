@php
    $enumClass = $useEnum != '' ? "App\\Enum\\{$useEnum}" : '';
@endphp

<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label for="{{ $fieldName }}" class="block text-sm font-semibold text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>
    <select name="{{ $fieldName }}" id="{{ $fieldName }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-white focus:ring-primary focus:border-primary @error($fieldName) border-red-500 @enderror">
        <option value="">{{ __('pages.select') }} {{ $label }}</option>

        @foreach ($loopValue as $value)
            <option value="{{ $value->value }}"
                {{ old($fieldName) == $value->value ? 'selected' : (isset($data) && $data == $value->value ? 'selected' : '') }}>

                {{ $enumClass::map($value->value) }}
            </option>
        @endforeach
    </select>

    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
