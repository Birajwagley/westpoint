<tr>
    @php
        $nameFieldIndex = 'name_contact.' . $index;
        $contactFieldIndex = 'contacts.' . $index;
    @endphp

    <td width="45%">
        <input type="text" name="name_contact[]" value="{{ old($nameFieldIndex, isset($data) ? $data->name : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($nameFieldIndex) border-red-500 @enderror">

        @error($nameFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </td>

    <td width="45%">
        <input type="text" name="contacts[]" value="{{ old($contactFieldIndex, isset($data) ? $data->contact : null) }}"
            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($contactFieldIndex) border-red-500 @enderror">

        @error($contactFieldIndex)
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </td>

    <td width="5%" class="text-center">
        <button type="button" id="contactAddButton"
            class="px-2 py-2 rounded-lg shadow-sm font-semibold text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-red-400 contact-remove">
            <i class="fa fa-trash" aria-hidden="true"></i>
        </button>
    </td>
</tr>
