<div class="parent-fields border p-3 mb-3 rounded-lg relative">
    <button type="button" class="remove-parent-btn absolute top-2 right-2 text-red-500 font-bold">&times;</button>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <x-fields.text-field
            label="Parent Name"
            :data="$parent['name'] ?? null"
            :fieldName="'parents['.$index.'][name]'"
            :required="true"/>

        <x-fields.text-field
            label="Relation"
            :data="$parent['relation'] ?? null"
            :fieldName="'parents['.$index.'][relation]'"
            :required="true"/>

        <x-fields.text-field
            label="Occupation"
            :data="$parent['occupation'] ?? null"
            :fieldName="'parents['.$index.'][occupation]'"
            :required="false"/>

        <x-fields.text-field
            label="Contact No"
            :data="$parent['contact_no'] ?? null"
            :fieldName="'parents['.$index.'][contact_no]'"
            :required="false"/>
    </div>
</div>
