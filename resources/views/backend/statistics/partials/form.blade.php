<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name En -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($statistic) ? $statistic->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name Np -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($statistic) ? $statistic->name_np : null)" fieldName="name_np" :required=false />

    <!-- Count -->
    <x-fields.integer-field label="Count" :data="old('count', isset($statistic) ? $statistic->count : 1)" fieldName="count" :required=true />

    <!-- Icon -->
    <x-fields.icon-field label="Icon" :data="old('icon', isset($statistic) ? $statistic->icon : null)" fieldName="icon" :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($statistic) ? $statistic->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($statistic) ? $statistic->is_published : null)" fieldName="is_published" :required=false />
</div>
