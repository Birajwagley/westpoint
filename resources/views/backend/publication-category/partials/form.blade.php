<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($publicationCategory) ? $publicationCategory->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($publicationCategory) ? $publicationCategory->name_np : null)" fieldName="name_np" :required=false />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($publicationCategory) ? $publicationCategory->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($publicationCategory) ? $publicationCategory->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($publicationCategory) ? $publicationCategory->is_featured : 0)" fieldName="is_featured" :required=false />
</div>

