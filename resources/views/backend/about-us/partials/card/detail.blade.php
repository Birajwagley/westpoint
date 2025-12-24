<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 card-detail">
    @php
        $cardCount = isset($cards) ? $cards->count() : 0;
        $nameEnFieldIndex = 'card_name_en.' . $index;
        $nameNpFieldIndex = 'card_name_np.' . $index;
        $imageFieldIndex = 'card_image.' . $index;
        $linkFieldIndex = 'card_link.' . $index;
        $shortEnFieldIndex = 'card_short_description_en.' . $index;
        $shortNpFieldIndex = 'card_short_description_np.' . $index;
    @endphp

    {{-- name en --}}
    <div>
        <input type="hidden" name="id[]" value="{{ isset($cardDetail) ? $cardDetail->id : null }}">

        <label for="card_name_en" class="block text-sm font-semibold text-gray-700">Name (English) <span
                class="text-red-600">*</span></label>

        <input type="text" name="card_name_en[]"
            value="{{ old($nameEnFieldIndex, isset($cardDetail) ? $cardDetail->name_en : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($nameEnFieldIndex) border-red-500 @enderror">

        @error($nameEnFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- name np --}}
    <div>
        <label for="card_name_np" class="block text-sm font-semibold text-gray-700">Name (Nepali)</label>

        <input type="text" name="card_name_np[]"
            value="{{ old($nameNpFieldIndex, isset($cardDetail) ? $cardDetail->name_np : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($nameNpFieldIndex) border-red-500 @enderror">

        @error($nameNpFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- iamge --}}
    <div>
        <label class="block text-sm font-semibold text-gray-700" for="card_image">Image
            <span class="text-red-600">*</span>
        </label>

        <input type="file" name="card_image[]" accept="image/*"
            class="image{{ $index }} mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($imageFieldIndex) border-red-500 @enderror">

        @error($imageFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror

        <div class="mt-4" id="current_image_div">
            <input type="hidden" name="current_image[]" id="current_image_value"
                value="{{ isset($cardDetail) && $cardDetail ? $cardDetail->image : null }}">
            @if (isset($cardDetail) && $cardDetail)
                <a href="{{ asset(isset($cardDetail) && $cardDetail ? $cardDetail->image : null) }}" target="_blank">
                    <div
                        class="w-24 h-24 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                        <img src="{{ asset(isset($cardDetail) && $cardDetail ? $cardDetail->image : null) }}"
                            alt="Current Image" class="w-full h-full object-cover">
                    </div>
                </a>
            @endif
        </div>
    </div>

    {{-- link --}}
    <div class="col-span-2">
        <label for="card_link" class="block text-sm font-semibold text-gray-700">Link <span
                class="text-red-600">*</span></label>

        <input type="url" name="card_link[]"
            value="{{ old($linkFieldIndex, isset($cardDetail) ? $cardDetail->link : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($linkFieldIndex) border-red-500 @enderror">

        @error($linkFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- short description en --}}
    <div class="col-span-2">
        <label for="card_short_description_en" class="block text-sm font-semibold text-gray-700">Short Description
            (English)
            <span class="text-red-600">*</span>
        </label>

        <input type="text" name="card_short_description_en[]"
            value="{{ old($shortEnFieldIndex, isset($cardDetail) ? $cardDetail->short_description_en : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($shortEnFieldIndex) border-red-500 @enderror">

        @error($shortEnFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- short description np --}}
    <div class="col-span-2">
        <label for="card_short_description_np" class="block text-sm font-semibold text-gray-700">Short
            Description
            (Nepali)</label>

        <input type="text" name="card_short_description_np[]"
            value="{{ old($shortNpFieldIndex, isset($cardDetail) ? $cardDetail->short_description_np : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($shortNpFieldIndex) border-red-500 @enderror">

        @error($shortNpFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="col-span-2">
        <button type="button"
            class="px-2 py-2 rounded-lg shadow-sm font-semibold text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 card-remove">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </div>

    <hr class="col-span-2 mb-4">
</div>
