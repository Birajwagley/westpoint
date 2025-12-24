<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 cronology-detail">
    @php
        $cronologyCount = isset($cronologies) ? $cronologies->count() : 0;
        $nameEnFieldIndex = 'cronology_name_en.' . $index;
        $nameNpFieldIndex = 'cronology_name_np.' . $index;
        $dateEnFieldIndex = 'cronology_date_en.' . $index;
        $dateNpFieldIndex = 'cronology_date_np.' . $index;
        $shortEnFieldIndex = 'cronology_short_description_en.' . $index;
        $shortNpFieldIndex = 'cronology_short_description_np.' . $index;
        $descriptionEnFieldIndex = 'cronology_description_en.' . $index;
        $descriptionNpFieldIndex = 'cronology_description_np.' . $index;
    @endphp

    {{-- id --}}
    <input type="hidden" name="id[]" value="{{ isset($cronologyDetail) ? $cronologyDetail->id : null }}">

    {{-- name en --}}
    <div>
        <label for="cronology_name_en" class="block text-sm font-semibold text-gray-700">Name (English) <span
                class="text-red-600">*</span></label>

        <input type="text" name="cronology_name_en[]"
            value="{{ old($nameEnFieldIndex, isset($cronologyDetail) ? $cronologyDetail->name_en : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($nameEnFieldIndex) border-red-500 @enderror">

        @error($nameEnFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- name np --}}
    <div>
        <label for="cronology_name_np" class="block text-sm font-semibold text-gray-700">Name (Nepali)</label>

        <input type="text" name="cronology_name_np[]"
            value="{{ old($nameNpFieldIndex, isset($cronologyDetail) ? $cronologyDetail->name_np : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($nameNpFieldIndex) border-red-500 @enderror">

        @error($nameNpFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- date en --}}
    <div>
        <label for="cronology_date_en" class="block text-sm font-semibold text-gray-700">Year (A.D.) <span
                class="text-red-600">*</span></label>

        <input type="text" name="cronology_date_en[]" id="dateEn{{ $index }}" data-key="{{ $index }}"
            pattern="\d{4}" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);"
            value="{{ old($dateEnFieldIndex, isset($cronologyDetail) ? $cronologyDetail->date_en : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($dateEnFieldIndex) border-red-500 @enderror">

        @error($dateEnFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- date np --}}
    <div>
        <label for="cronology_date_np" class="block text-sm font-semibold text-gray-700">Year (B.S.) <span
                class="text-red-600">*</span></label>

        <input type="text" name="cronology_date_np[]" id="dateNp{{ $index }}" data-key="{{ $index }}"
            pattern="\d{4}" maxlength="4" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 4);"
            value="{{ old($dateNpFieldIndex, isset($cronologyDetail) ? $cronologyDetail->date_np : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($dateNpFieldIndex) border-red-500 @enderror">

        @error($dateNpFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- description en --}}
    <div class="col-span-2">
        <label for="cronology_description_en" class="block text-sm font-semibold text-gray-700">Description (English)
            <span class="text-red-600">*</span>
        </label>

        <textarea name="cronology_description_en[]" id="{{ $descriptionEnFieldIndex }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary summernote">{{ old($descriptionEnFieldIndex, isset($cronologyDetail) ? $cronologyDetail->description_en : null) }}</textarea>

        @error($descriptionEnFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- description np --}}
    <div class="col-span-2">
        <label for="cronology_description_np" class="block text-sm font-semibold text-gray-700">Description
            (Nepali)</label>

        <textarea name="cronology_description_np[]" id="{{ $descriptionNpFieldIndex }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary summernote">{{ old($descriptionNpFieldIndex, isset($cronologyDetail) ? $cronologyDetail->description_np : null) }}</textarea>

        @error($descriptionNpFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-span-4">
        <button type="button"
            class="px-2 py-2 rounded-lg shadow-sm font-semibold text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 cronology-remove">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </div>

    <hr class="col-span-4 mb-4">
</div>
