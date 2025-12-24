<form action="{{ route('aboutus.update-about-us', $aboutUs->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- image one -->
        <x-fields.image-upload-field label="Image One" :data="old('image_one', isset($aboutUs) ? $aboutUs->image_one : null)" fieldName="image_one"
            currentName="current_image_one" :required=true />

        <!-- image two -->
        <x-fields.image-upload-field label="Image Two" :data="old('image_two', isset($aboutUs) ? $aboutUs->image_two : null)" fieldName="image_two"
            currentName="current_image_two" :required=true />

        <!-- image three -->
        <x-fields.image-upload-field label="Image Three" :data="old('image_three', isset($aboutUs) ? $aboutUs->image_three : null)" fieldName="image_three"
            currentName="current_image_three" :required=true />

        <!-- Title En -->
        <x-fields.text-field label="Title (English)" :data="old('title_en', isset($aboutUs) ? $aboutUs->title_en : null)" fieldName="title_en" :required=true />

        <!-- Title Np -->
        <x-fields.text-field label="Title (Nepali)" :data="old('title_np', isset($aboutUs) ? $aboutUs->title_np : null)" fieldName="title_np" :required=false />

        {{-- Description (English) --}}
        <x-fields.textarea-summernote-field label="Description (English)" :data="old('description_en', $aboutUs->description_en ?? null)" fieldName="description_en"
            :required=true class="col-span-3" />

        {{-- Description (Nepali) --}}
        <x-fields.textarea-summernote-field label="Description (Nepali)" :data="old('description_np', $aboutUs->description_np ?? null)" fieldName="description_np"
            :required=false class="col-span-3" />

        {{-- Mission (English) --}}
        <x-fields.textarea-summernote-field label="Mission (English)" :data="old('mission_en', $aboutUs->mission_en ?? null)" fieldName="mission_en"
            :required=true class="col-span-3" />

        {{-- Mission (Nepali) --}}
        <x-fields.textarea-summernote-field label="Mission (Nepali)" :data="old('mission_np', $aboutUs->mission_np ?? null)" fieldName="mission_np"
            :required=false class="col-span-3" />

        {{-- Vision (English) --}}
        <x-fields.textarea-summernote-field label="Vision (English)" :data="old('vision_en', $aboutUs->vision_en ?? null)" fieldName="vision_en"
            :required=true class="col-span-3" />

        {{-- Vision (Nepali) --}}
        <x-fields.textarea-summernote-field label="Vision (Nepali)" :data="old('vision_np', $aboutUs->vision_np ?? null)" fieldName="vision_np"
            :required=false class="col-span-3" />
    </div>

    <div class="flex mt-6 gap-2">
        <x-buttons.form-save-button type="Update" />
        <x-buttons.form-cancel-button href="{{ route('aboutus.edit') }}" />
    </div>
</form>
