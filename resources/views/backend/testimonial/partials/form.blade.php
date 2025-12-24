@php
    use App\Enum\PerspectiveFromEnum;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    @if (isset($testimonial) && $testimonial->perspective_from == PerspectiveFromEnum::ALUMNI->value)
        <input type="hidden" name="perspective_from" value="{{ $testimonial->perspective_from }}">
    @else
        <!-- Type -->
        <x-fields.select-enum-field label="Type" :data="isset($testimonial) ? $testimonial->perspective_from : ''" fieldName="perspective_from" :required=true
            :loopValue="$perspectiveType" useEnum="PerspectiveFromEnum" />
    @endif

    <!-- Image -->
    <x-fields.image-upload-field label="Image" :data="old('image', isset($testimonial) ? $testimonial->image : null)" fieldName="image" currentName="current_image"
        :required=true />

    <!-- Full Name -->
    <x-fields.text-field label="Full Name" :data="old('full_name', isset($testimonial) ? $testimonial->full_name : null)" fieldName="full_name" :required=true />

    {{-- video url --}}
    <x-fields.url-field class="md:col-span-2 lg:col-span-3" label="Testimonial (Video Url)" :data="old('testimonial_video', isset($testimonial) ? $testimonial->testimonial_video : null)"
        fieldName="testimonial_video" :required=false />

    <!-- Testimonial -->
    <x-fields.textarea-summernote-field class="md:col-span-2 lg:col-span-3" label="Testimonial" :data="old('testimonial_text', isset($testimonial) ? $testimonial->testimonial_text : null)"
        fieldName="testimonial_text" :required=true />

    <!-- Is Featured -->
    <x-fields.boolean-field label="Is Featured?" :data="old('is_featured', isset($testimonial) ? $testimonial->is_featured : 0)" fieldName="is_featured" :required=false />
</div>


@push('scripts')
    <script>
        $('#image').on('change', function() {
            fieldId = $(this).attr('id');

            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden');
                $('#current_' + fieldId + '_value').val(null);
            }
        });
    </script>
@endpush
