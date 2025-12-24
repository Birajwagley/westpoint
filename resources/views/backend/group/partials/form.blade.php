<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name -->
    <x-fields.text-field label="Name" :data="old('name', isset($group) ? $group->name : null)" fieldName="name" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($group) ? $group->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($group) ? $group->is_published : null)" fieldName="is_published" :required=false />

    <!-- Have Multi Subject -->
    <x-fields.boolean-field label="Have Multi Subject?" :data="old('have_multi_subject', isset($group) ? $group->have_multi_subject : null)" fieldName="have_multi_subject"
        :required=false />
</div>
