<div class="grid grid-cols-1 gap-4">
    <!-- Email -->
    <x-fields.text-field label="Email" :data="old('email', isset($subscription) ? $subscription->email : null)" fieldName="email" :required=true />

    <!-- Is Active -->
    <x-fields.boolean-field label="Is Active?" :data="old('is_active', isset($subscription) ? $subscription->is_active : null)" fieldName="is_active" :required=false />

</div>
