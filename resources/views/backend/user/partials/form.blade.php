<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Thumbnail Image -->
    <x-fields.image-upload-field label="Thumbnail Image" :data="old('thumbnail_image', isset($user) ? $user->thumbnail_image : null)" fieldName="thumbnail_image"
        currentName="current_thumbnail_image" :required=true />

    <!-- Username -->
    <x-fields.text-field label="Username" :data="old('username', isset($user) ? $user->username : null)" fieldName="username" :required=true />

    <!-- Name -->
    <x-fields.text-field label="Name" :data="old('name', isset($user) ? $user->name : null)" fieldName="name" :required=true />

    <!-- Email -->
    <div>
        <label class="block text-sm font-semibold text-gray-700" for="email">Email <span
                class="text-red-600">*</span></label>
        <input type="email" id="email" name="email"
            value="{{ old('email', isset($user) ? $user->email : null) }}"
            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror">
        @error('email')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <!-- Role -->
    <x-fields.select-field label="Role" :data="isset($user) ? $user->roles->first()->id : ''" fieldName="role_id" :required=true :loopValue="$roles" />

    <!-- Password -->
    <x-fields.password-field label="Password" fieldName="password" :required=true />

    <!-- Password Confirmation -->
    <x-fields.password-field label="Password Confirmation" fieldName="password_confirmation" :required=true />

    <!-- Is Active -->
    <x-fields.boolean-field label="Is Active?" :data="old('is_active', isset($user) ? $user->is_active : 1)" fieldName="is_active" :required=true />
</div>

@push('scripts')
    <script>
        $('#thumbnail_image').on('change', function() {
            if (this.files.length > 0) {
                $('#current_thumbnail_image_div').addClass('hidden'); // Hide the primary logo preview
                $('#current_thumbnail_image_value').val(null); // Clear the current primary logo value
            }
        });
    </script>
@endpush
