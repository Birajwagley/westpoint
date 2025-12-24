<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label for="{{ $fieldName }}" class="block text-sm font-semibold text-gray-700">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <div class="get-and-preview">
        <div class="grid grid-cols-2">
            <div>
                <div class="icon-preview" data-toggle="tooltip" title="Preview of selected Icon">
                    <i id="IconPreview" class="{{ old($fieldName, isset($data) ? $data : null) }}"></i>
                </div>

                <input type="text" id="IconInput" class="hidden" name="icon"
                    value="{{ old($fieldName, isset($data) ? $data : null) }}" />
            </div>

            <button type="button" id="GetIconPicker" data-iconpicker-input="#IconInput"
                data-iconpicker-preview="#IconPreview"
                class="px-6 py-2
                    rounded-lg shadow-sm
                    font-semibold text-blue-900
                    border border-blue-900
                    hover:bg-blue-900 hover:text-white
                    focus:outline-none focus:ring-2 focus:ring-blue-400">
                Select Icon
            </button>
        </div>
    </div>

    @error('icon')
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror
</div>

@push('scripts')
    <script>
        IconPicker.Init({
            jsonUrl: "{{ asset('assets/backend/plugins/fontawesome/iconpicker-1.5.0.json') }}",
            searchPlaceholder: 'Search Icon',
            showAllButton: 'Show All',
            cancelButton: 'Cancel',
            noResultsFound: 'No results found.',
        });

        IconPicker.Run('#GetIconPicker');
    </script>
@endpush
