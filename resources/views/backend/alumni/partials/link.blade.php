<tr>
    @php
        $linkNameFieldIndex = 'link_name.' . $index;
        $linkFieldIndex = 'link.' . $index;
    @endphp

    <td width="30%">
        <input type="text" name="link_name[]" value="{{ old($linkNameFieldIndex, $data['name'] ?? '') }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($linkNameFieldIndex) border-red-500 @enderror">

        @error($linkNameFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </td>

    <td width="60%">
        <input type="url" name="link[]" value="{{ old($linkFieldIndex, $data['link'] ?? '') }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($linkFieldIndex) border-red-500 @enderror">

        @error($linkFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </td>

    <td width="5%" class="text-center">
        <button type="button" id="linkAddButton"
            class="px-2 py-2 rounded-lg shadow-sm font-semibold text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 link-remove">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </td>
</tr>
