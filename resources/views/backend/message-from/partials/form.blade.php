@php
    $showFields = $messageFrom->slug == App\Enum\MessageFromTypeEnum::GYANBAHADURYAKTHUMBA->value ? true : false;
@endphp

<div x-data="{ tab: localStorage.getItem('selectedTab') || 'english' }" x-init="$watch('tab', value => localStorage.setItem('selectedTab', value))" class="w-full mx-auto">
    <!-- Tabs -->
    <div class="flex bg-gray-100 p-1 rounded-xl">
        <button @click="tab = 'english'" type="button"
            :class="tab === 'english'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            English Content
        </button>
        <button @click="tab = 'nepali'" type="button"
            :class="tab === 'nepali'
                ?
                'bg-gray-400 text-white shadow' :
                'text-gray-600 hover:text-gray-400'"
            class="flex-1 text-center py-2 rounded-lg font-semibold transition-all">
            Nepali Content
        </button>
    </div>

    <!-- Tab Content -->
    <div class="p-4 rounded-b-lg">
        <div x-show="tab === 'english'">
            <form action="{{ route('message-from.update', $messageFrom->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="slug" value="{{ $messageFrom->slug }}">
                <input type="hidden" name="type" value="en">

                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-3 gap-4">
                    {{-- image --}}
                    <x-fields.image-upload-field label="Photo" :data="old('image', isset($messageFrom) ? $messageFrom->image : null)" fieldName="image"
                        currentName="current_image" :required=true />

                    <!-- Name -->
                    <x-fields.text-field class="col-span-2" label="Name" :data="old('name', $informationEn->name ?? null)" fieldName="name"
                        :required=true />
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4 mt-3">
                    {{-- Designation --}}
                    <x-fields.select-field class="{{ $showFields ? 'hidden' : '' }}" label="Designation"
                        :data="$informationEn->designation_id ?? ''" fieldName="designation_id" :required=true :loopValue="$designations" />

                    {{-- Department --}}
                    <x-fields.select-field class="{{ $showFields ? 'hidden' : '' }}" label="Department"
                        :data="$informationEn->department_id ?? ''" fieldName="department_id" :required=true :loopValue="$departments" />

                    {{-- Date of Birth AD --}}
                    <x-fields.date-field class="{{ $showFields ? 'hidden' : '' }}" label="Date of Birth (A.D.)"
                        :data="old('date_of_birth', $informationEn->date_of_birth ?? null)" fieldName="date_of_birth" :required=true />

                    <!-- Correspondance Address -->
                    <x-fields.text-field class="{{ $showFields ? 'hidden' : '' }}" label="Correspondance Address"
                        :data="old('correspondaence_address', $informationEn->correspondaence_address ?? null)" fieldName="correspondaence_address" :required=true />

                    <!-- Permanent Address -->
                    <x-fields.text-field class="{{ $showFields ? 'hidden' : '' }}" label="Permanent Address"
                        :data="old('permanent_address', $informationEn->permanent_address ?? null)" fieldName="permanent_address" :required=true />

                    {{-- countries visited --}}
                    <div class="col-span-2 {{ $showFields ? 'hidden' : '' }}">
                        <label for="country_visited" class="block text-sm font-semibold text-gray-700">Countries
                            Visited <span class="text-red-600">*</span>
                        </label>

                        @php
                            if (isset($informationEn)) {
                                $componentIds = $informationEn->country_visited ?? [];
                            }
                        @endphp

                        <select name="country_visited[]"
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('country_visited') border-red-500 @enderror select-multi-1"
                            multiple>
                            @foreach ($countries as $code => $country)
                                <option value="{{ $code }}"
                                    {{ isset($informationEn->country_visited) ? (in_array($code, $componentIds) == true ? 'selected' : '') : (in_array($code, old('country_visited') ?? []) ? 'selected' : '') }}>
                                    {{ $country['emoji'] }}&nbsp;{{ $country['name'] }}
                                </option>
                            @endforeach
                        </select>

                        @error('country_visited')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- external link --}}
                    <x-fields.url-field class="col-span-2" label="External Link" :data="old('external_link', $informationEn->external_link ?? null)"
                        fieldName="external_link" :required=false />

                    {{-- Educational Qualification --}}
                    <x-fields.textarea-summernote-field label="Educational Qualification" :data="old('educational_qualification', $informationEn->educational_qualification ?? null)"
                        fieldName="educational_qualification" :required=true
                        class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Awards --}}
                    <x-fields.textarea-summernote-field label="Awards" :data="old('awards', $informationEn->awards ?? null)" fieldName="awards"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Seminar --}}
                    <x-fields.textarea-summernote-field label="Seminar" :data="old('seminar', $informationEn->seminar ?? null)" fieldName="seminar"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Experience --}}
                    <x-fields.textarea-summernote-field label="Experience" :data="old('experience', $informationEn->experience ?? null)" fieldName="experience"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Description --}}
                    <x-fields.textarea-summernote-field label="Description" :data="old('description', $informationEn->description ?? null)" fieldName="description"
                        :required=false class="col-span-2" />
                </div>

                <div class="flex mt-6 gap-2">
                    <x-buttons.form-save-button type="Update" />
                    <x-buttons.form-cancel-button href="{{ route('message-from.index') }}" />
                </div>
            </form>
        </div>

        <div x-show="tab === 'nepali'">
            <form action="{{ route('message-from.update', $messageFrom->id) }}" method="POST"
                enctype="multipart/form-data">
                @method('PUT')
                @csrf

                <input type="hidden" name="slug" value="{{ $messageFrom->slug }}">
                <input type="hidden" name="type" value="np">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                    <!-- Name -->
                    <x-fields.text-field class="col-span-2" label="Name" :data="old('name', $informationNp->name ?? null)" fieldName="name"
                        :required=true />

                    {{-- Designation --}}
                    <x-fields.select-field class="{{ $showFields ? 'hidden' : '' }}" id="principal" label="Designation"
                        :data="$informationNp->designation_id ?? ''" fieldName="designation_id" :required=true :loopValue="$designations" />

                    {{-- Date of Birth BS --}}
                    <x-fields.date-field class="{{ $showFields ? 'hidden' : '' }}" label="Date of Birth (B.S.)"
                        :data="old('date_of_birth', $informationNp->date_of_birth ?? null)" fieldName="date_of_birth" :required=true />

                    <!-- Correspondance Address -->
                    <x-fields.text-field class="{{ $showFields ? 'hidden' : '' }}" label="Correspondance Address"
                        :data="old('correspondaence_address', $informationNp->correspondaence_address ?? null)" fieldName="correspondaence_address" :required=true />

                    <!-- Permanent Address -->
                    <x-fields.text-field class="{{ $showFields ? 'hidden' : '' }}" label="Permanent Address"
                        :data="old('permanent_address', $informationNp->permanent_address ?? null)" fieldName="permanent_address" :required=true />

                    {{-- countries visited --}}
                    <div class="col-span-2 {{ $showFields ? 'hidden' : '' }}">
                        <label for="country_visited" class="block text-sm font-semibold text-gray-700">Countries
                            Visited <span class="text-red-600">*</span>
                        </label>

                        @php
                            if (isset($informationEn)) {
                                $componentIds = $informationNp->country_visited ?? [];
                            }
                        @endphp

                        <select name="country_visited[]"
                            class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('country_visited') border-red-500 @enderror select-multi-2"
                            multiple>
                            @foreach ($countries as $code => $country)
                                <option value="{{ $code }}"
                                    {{ isset($informationEn->country_visited) ? (in_array($code, $componentIds) == true ? 'selected' : '') : (in_array($code, old('country_visited') ?? []) ? 'selected' : '') }}>
                                    {{ $country['emoji'] }}&nbsp;{{ $country['name'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- external link --}}
                    <x-fields.url-field class="col-span-2" label="External Link" :data="old('external_link', $informationNp->external_link ?? null)"
                        fieldName="external_link" :required=false />

                    {{-- Educational Qualification --}}
                    <x-fields.textarea-summernote-field label="Educational Qualification" :data="old('educational_qualification', $informationNp->educational_qualification ?? null)"
                        fieldName="educational_qualification" :required=true
                        class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Awards --}}
                    <x-fields.textarea-summernote-field label="Awards" :data="old('awards', $informationNp->awards ?? null)" fieldName="awards"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Seminar --}}
                    <x-fields.textarea-summernote-field label="Seminar" :data="old('seminar', $informationNp->seminar ?? null)" fieldName="seminar"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Experience --}}
                    <x-fields.textarea-summernote-field label="Experience" :data="old('experience', $informationNp->experience ?? null)" fieldName="experience"
                        :required=true class="col-span-2 {{ $showFields ? 'hidden' : '' }}" />

                    {{-- Description --}}
                    <x-fields.textarea-summernote-field label="Description" :data="old('description', $informationNp->description ?? null)" fieldName="description"
                        :required=false class="col-span-2" />
                </div>

                <div class="flex mt-6 gap-2">
                    <x-buttons.form-save-button type="Update" />
                    <x-buttons.form-cancel-button href="{{ route('message-from.index') }}" />
                </div>
            </form>
        </div>
    </div>
</div>
