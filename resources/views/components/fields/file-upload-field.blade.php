<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700" for="{{ $fieldName }}">
        {{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <input type="file" name="{{ $fieldName }}" id="{{ $fieldName }}" accept="{{ $accept }}"
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($fieldName) border-red-500 @enderror">

    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror

    @if (isset($data))
        <div class="mt-4 flex flex-row items-center space-x-3" id="{{ $currentName }}_div">
            <input type="hidden" name="{{ $currentName }}" value="{{ $data }}"
                id="{{ $currentName }}_value">

            <a href="{{ asset($data) }}" target="_blank">
                <div
                    class="w-16 h-16 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                    <img src="{{ asset($data) }}" alt="Current {{ $label }}"
                        class="w-full h-full object-cover">
                </div>
            </a>
        </div>
    @endif
</div>
