@php
    use App\Enum\MenuTypeEnum;
@endphp

@if (session('warning'))
    <div class="bg-yellow-100 text-yellow-800 border border-yellow-300 p-4 rounded-md mb-2">
        {{ session('warning') }}
    </div>
@endif

<!-- Slug Display -->
<div class="mb-4" id="slugDiv">
    <div class="inline-block bg-blue-50 border border-blue-500 rounded-lg px-4 py-2 shadow-sm">
        <span class="text-sm font-semibold text-gray-600">Slug:</span>
        <span id="slug"
            class="text-sm font-bold text-blue-600 ">{{ old('slug', isset($menuData) ? $menuData->slug : '') }}</span>
    </div>
    <input type="hidden" name="slug" value="{{ old('slug', isset($menuData) ? $menuData->slug : '') }}">
</div>

<!-- Form Fields -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- type -->
    <x-fields.select-enum-field label="Type" :data="isset($menuData) ? $menuData->type : ''" fieldName="type" :required=true :loopValue="$types"
        useEnum="MenuTypeEnum" />

    <!-- External link (Slug Input) -->
    <x-fields.url-field class="col-span-2 hidden" id="externalLinkSpace" label="External Link" :data="old('external_link', isset($menuData) ? $menuData->external_link : null)"
        fieldName="external_link" :required=false />

    <!-- Parent -->
    <x-fields.select-field label="Parent" :data="isset($menuData) ? $menuData->parent_id : ''" fieldName="parent_id" :required=false :loopValue="$menus" />

    <!-- Name EN -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($menuData) ? $menuData->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name NP -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($menuData) ? $menuData->name_np : null)" fieldName="name_np" :required=false />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($menuData) ? $menuData->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Featured Navigation -->
    <x-fields.boolean-field label="Is Featured Navigation?" :data="old('is_featured_navigation', isset($menuData) ? $menuData->is_featured_navigation : 0)" fieldName="is_featured_navigation"
        :required=true />

    <!-- Icon -->
    <x-fields.icon-field id="iconField" label="Icon" :data="old('icon', isset($statistic) ? $statistic->icon : null)" fieldName="icon" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($menuData) ? $menuData->is_published : 1)" fieldName="is_published" :required=true />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            type = @json(old('type')) ? @json(old('type')) : $('#type').val();

            checkType(type);
        });

        $('#type').change(function(e) {
            e.preventDefault();
            type = $('#type').val();

            checkType(type);
        });

        $(document).on('input', '#name_en', function() {
            type = $('#type').val();
            if (type == @json(MenuTypeEnum::SLUG->value)) {
                let nameEnValue = $(this).val();
                let slug = generateSlug(nameEnValue);
                $('input[name=slug]').val(slug);
                $('#slug').text(slug);
            }
        });

        function generateSlug(text) {
            return text
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-');
        }

        function checkType(type) {
            if (type == @json(MenuTypeEnum::SLUG->value)) {
                $('#slugDiv').removeClass('hidden');

                $('#slugSpace').removeClass('hidden');
                $('#externalLinkSpace').val('').addClass('hidden');

                nameEn = $('#name_en').val();
                if (nameEn != '') {
                    let slug = generateSlug(nameEn);
                    $('input[name=slug]').val(slug);
                    $('#slug').text(slug);

                }
            } else {
                $('#slugDiv').addClass('hidden');

                $('#externalLinkSpace').removeClass('hidden');
                $('#slugSpace').addClass('hidden');
                $('input[name=slug]').val('');
                $('#slug').text('');
            }
        }


        //Is Featured Field

        $(document).ready(function() {
            let isFeatured = $('input[name=is_featured_navigation]:checked').val();
            toggleIcon(isFeatured);

            // On change
            $(document).on('change', 'input[name=is_featured_navigation]', function() {
                let value = $(this).val();
                toggleIcon(value);
            });

            function toggleIcon(value) {
                if (value == 1) {
                    $('#iconField').removeClass('hidden');
                } else {
                    $('#iconField').addClass('hidden');
                    $('#iconField input[type=file]').val(''); // clear if hidden
                }
            }
        });
    </script>
@endpush
