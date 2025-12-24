<form action="{{ route('faculty.group-subject', $faculty->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    @method('PUT')

    <table class="bg-white shadow-md rounded-lg overflow-hidden text-sm" width="100%">
        <thead class="bg-secondary">
            <tr>
                <th class="px-5 py-3 text-left text-white uppercase tracking-wider">Group</th>
                <th class="px-5 py-3 text-left text-white uppercase tracking-wider">Subject</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($groups as $key => $group)
                @php
                    $data = null;
                    if (isset($faculty->groupSubjectFaculties)) {
                        $data = $faculty->groupSubjectFaculties->where('group_id', $group->id)->pluck('subject_id');
                    }
                @endphp

                <tr class="hover:bg-gray-50 transition-colors duration-200">
                    <td width="30%" class="px-5 py-4 font-medium text-gray-700 align-top">
                        {{ $group->name }}

                        <input type="hidden" name="group_id[{{ $key }}]" value="{{ $group->id }}">
                    </td>

                    <td class="pr-5">
                        @if ($group->have_multi_subject)
                            <select name="subject_id[{{ $key }}][]"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('subject_id.' . $key) border-red-500 @enderror select-multi"
                                multiple>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ isset($data) && in_array($subject->id, $data->toArray()) ? 'selected' : '' }}>
                                        {{ $subject->name_en }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <select name="subject_id[{{ $key }}]"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error('subject_id.' . $key) border-red-500 @enderror">
                                <option value=''>-- Select Subject --</option>
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}"
                                        {{ old('subject_id.' . $key, $data[0] ?? '') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name_en }}
                                    </option>
                                @endforeach
                            </select>
                        @endif
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="pr-5">
                        @error('subject_id.' . $key)
                            <p class="text-sm text-red-600 mt-1 text-end">{{ $message }}</p>
                        @enderror
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="flex mt-6 gap-2">
        <x-buttons.form-save-button type="Save" />
        <x-buttons.form-cancel-button href="{{ route('faculty.index') }}" />
    </div>
</form>
