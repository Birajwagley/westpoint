@php
    use App\Enum\DrawerNavigationType;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    <!-- Name EN -->
    <x-fields.text-field label="Name (English)" :data="old('name_en', isset($drawerNavigation) ? $drawerNavigation->name_en : null)" fieldName="name_en" :required=true />

    <!-- Name NP -->
    <x-fields.text-field label="Name (Nepali)" :data="old('name_np', isset($drawerNavigation) ? $drawerNavigation->name_np : null)" fieldName="name_np" :required=false />

    <!-- Icon -->
    <x-fields.icon-field label="Icon" :data="old('icon', isset($drawerNavigation) ? $drawerNavigation->icon : null)" fieldName="icon" :required=true />

    {{-- type --}}
    <x-fields.select-enum-field label="Navigation Type" :data="isset($drawerNavigation) ? $drawerNavigation->type : ''" fieldName="type" :required=true
        :loopValue="$types" useEnum="DrawerNavigationType" />

    {{-- menu --}}
    <x-fields.select-field label="Parent" :data="isset($drawerNavigation) ? $drawerNavigation->menu_id : ''" fieldName="menu_id" :required=true :loopValue="$menus"
        class="hidden" id="menuType" />

    {{-- Value --}}
    <x-fields.text-field label="Value" :data="old('value', isset($drawerNavigation) ? $drawerNavigation->value : null)" fieldName="value" :required=true class="col-span-2 hidden"
        id="otherType" />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($drawerNavigation) ? $drawerNavigation->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($drawerNavigation) ? $drawerNavigation->is_published : 1)" fieldName="is_published" :required=false />
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            value = $('#type').val();

            navigationType(value);
        });

        $('#type').change(function(e) {
            e.preventDefault();
            value = $(this).val();

            navigationType(value);
        });

        function navigationType(value) {
            if (value == @json(DrawerNavigationType::MENU->value)) {
                $('#menuType').removeClass('hidden');
                $('#otherType').addClass('hidden')

                $('#value').val('');
            } else {
                $('#otherType').removeClass('hidden');
                $('#menuType').addClass('hidden');

                $('#menu_id').val('').trigger('change');
            }
        }
    </script>
@endpush
