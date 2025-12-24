<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

    <!-- Select Faq -->
    <x-fields.select-field label="Faq Category" :data="isset($faq) ? $faq->faq_category_id : ''" fieldName="faq_category_id" :required=true
        :loopValue="$faqCategories" />

    <!-- Question En -->
    <x-fields.text-field label="Question (English)" :data="old('question_en', isset($faq) ? $faq->question_en : null)" fieldName="question_en" :required=true />

    <!-- Question Np -->
    <x-fields.text-field label="Question (Nepali)" :data="old('question_np', isset($faq) ? $faq->question_np : null)" fieldName="question_np" :required=false />

    <!-- Answer En -->
    <x-fields.text-field label="Answer (English)" :data="old('answer_en', isset($faq) ? $faq->answer_en : null)" fieldName="answer_en" :required=true />

    <!-- Answer Np -->
    <x-fields.text-field label="Answer (Nepali)" :data="old('answer_np', isset($faq) ? $faq->answer_np : null)" fieldName="answer_np" :required=false />

    <!-- Display Order -->
    <x-fields.integer-field label="Display Order" :data="old('display_order', isset($faq) ? $faq->display_order : $displayOrder)" fieldName="display_order" :required=true />

    <!-- Is Published -->
    <x-fields.boolean-field label="Is Published?" :data="old('is_published', isset($faq) ? $faq->is_published : null)" fieldName="is_published" :required=false />
</div>

@push('scripts')
    <script>
        $('#file').on('change', function() {
            fieldId = $(this).attr('id');
            if (this.files.length > 0) {
                $('#current_' + fieldId + '_div').addClass('hidden');
                $('#current_' + fieldId + '_value').val(null);
            }
        });
    </script>
@endpush
