@php
    use App\Enum\LinkTypeEnum;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name EN -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($link) ? $link->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name NP -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($link) ? $link->name_np : null)" fieldName="name_np" :required=false />

    <!-- link type -->
    <x-fields.select-enum-field label="Link Type" :data="isset($link) ? $link->type : ''" fieldName="type" :required=true :loopValue="$types"
        useEnum="LinkTypeEnum" />

    <!-- menu -->
    <x-fields.select-field class="hidden" id="menuSection" label="Menu" :data="isset($link) ? $link->menu_id : ''" fieldName="menu_id"
        :required=true :loopValue="$menus" />

    <!-- External Link -->
    <x-fields.url-field class="col-span-3 hidden" id="urlSection" label="Url" :data="old('url', isset($link) ? $link->url : null)" fieldName="url"
        :required=true />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($link) ? $link->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($link) ? $link->is_published : 1)" fieldName="is_published" :required=false />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            checkType();
        });

        $('#type').change(function(e) {
            e.preventDefault();

            checkType();
        });

        function checkType() {
            type = $('#type').val();

            if (type == @json(LinkTypeEnum::MENU->value)) {
                $('#menuSection').removeClass('hidden');
                $('#urlSection').addClass('hidden');

                $('#url').val(null);
            } else {
                $('#menuSection').addClass('hidden');
                $('#urlSection').removeClass('hidden');

                $('#menu_id').val('').trigger('change');
            }
        }
    </script>
@endpush
