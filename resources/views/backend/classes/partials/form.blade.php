<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($class) ? $class->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($class) ? $class->name_np : null)" fieldName="name_np" :required=false />

    <!-- Icon -->
    <x-fields.icon-field label="Icon" :data="old('icon', isset($class) ? $class->icon : null)" fieldName="icon" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($class) ? $class->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($class) ? $class->is_published : 1)" fieldName="is_published" :required=false />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Admission Allowed?" :data="old('is_admission_allowed', isset($class) ? $class->is_admission_allowed : 0)" fieldName="is_admission_allowed"
        :required=false />

    <!-- description en -->
    <x-fields.textarea-summernote-field class="col-span-1 md:col-span-2 lg:col-span-3" label="Description (English)"
        :data="old('description_en', isset($class) ? $class->description_en : null)" fieldName="description_en" :required=true />

    <!-- description np -->
    <x-fields.textarea-summernote-field class="col-span-1 md:col-span-2 lg:col-span-3" label="Description (Nepali)"
        :data="old('description_np', isset($class) ? $class->description_np : null)" fieldName="description_np" :required=false />
</div>
