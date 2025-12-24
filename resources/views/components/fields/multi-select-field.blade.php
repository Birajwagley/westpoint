<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label for="{{ $fieldName }}" class="block text-sm font-semibold text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    @php
        if (isset($data)) {
            $componentIds = $data;
        } elseif (old($fieldName)) {
            $componentIds = old($fieldName);
        }
    @endphp

    <select name="{{ $fieldName }}[]" id="{{ $fieldName }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($fieldName) border-red-500 @enderror select-multi"
        multiple>
        @foreach ($loopValue as $key => $value)
            @php
                $optionValue = is_object($value) ? $value->id : $key;
                $optionLabel = is_object($value)
                    ? $value->name_en . (isset($value->name_np) ? ' | ' . $value->name_np : '')
                    : $value;
            @endphp
            <option value="{{ $optionValue }}"
                {{ isset($componentIds) && in_array($optionValue, $componentIds) ? 'selected' : '' }}>
                {{ $optionLabel }}
            </option>
        @endforeach
    </select>


    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>
