<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Name -->
    <x-fields.text-field label="Name" :data="old('name', isset($role) ? $role->name : null)" fieldName="name" :required=true />

    <!-- Permissions -->
    <div class="md:col-span-2">
        <label class="block text-sm font-semibold text-gray-700 mb-2">
            Permissions <span class="text-red-600">*</span>
        </label>

        @error('permissions')
            <p class="text-sm text-red-600 mb-2">{{ $message }}</p>
        @enderror

        <div class="flex items-center space-x-2">
            <input type="checkbox" id="permission-all" class="form-checkbox text-blue-600" />
            <label for="permission-all" class="text-gray-700 select-none font-semibold">
                All
            </label>
        </div>

        @php
            $selectedPermissions = isset($role) ? $role->permissions->pluck('id')->toArray() : [];
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-6 gap-4">
            @foreach ($permissions as $key => $permission)
                <div class="flex items-center space-x-2">
                    <input type="checkbox" id="permission-{{ $key }}" name="permissions[]"
                        value="{{ $permission->id }}" class="permission form-checkbox text-blue-600"
                        {{ in_array($permission->id, old('permissions', $selectedPermissions)) ? 'checked' : '' }} />
                    <label for="permission-{{ $key }}" class="text-gray-700 select-none font-semibold">
                        {{ $permission->name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $('#permission-all').change(function(e) {
            e.preventDefault();

            $(".permission").prop("checked", $(this).prop("checked"));
        });

        $(".permission").on("change", function() {
            if ($(".permission:checked").length === $(".permission").length) {
                $("#permission-all").prop("checked", true);
            } else {
                $("#permission-all").prop("checked", false);
            }
        });
    </script>
@endpush
