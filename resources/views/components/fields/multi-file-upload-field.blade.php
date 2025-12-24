<div class="{{ $class ?? '' }}" id="{{ $id ?? '' }}">
    <label class="block text-sm font-semibold text-gray-700" for="{{ $fieldName }}">{{ $label }}
        @if ($required)
            <span class="text-red-600">*</span>
        @endif
    </label>

    <input type="file" name="{{ $fieldName }}[]" id="{{ $fieldName }}" accept="{{ $accept }}" multiple
        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-primary focus:border-primary @error($fieldName) border-red-500 @enderror">

    @error($fieldName)
        <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
    @enderror

    @if (isset($data))
        <div class="mt-4 flex flex-wrap gap-3" id="{{ $currentName }}_div">
            <input type="hidden" name="{{ $currentName }}[]" value="{{ $data }}"
                id="{{ $currentName }}_value">

            @foreach (json_decode($data) as $key => $image)
                <div class="relative  w-[80px] h-[80px]">
                    <!-- Cross button -->
                    <button type="button"
                        class="absolute top-1 right-1 w-6 h-6 flex items-center justify-center bg-white rounded-full shadow-md text-gray-600 hover:bg-red-500 hover:text-white transition"
                        onclick="removeImage(this, '{{ $image }}')" data-index="{{ $key }}">
                        <i class="fa fa-times"></i>
                    </button>

                    <div
                        class="w-20 h-20 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                        <a href="{{ asset($image) }}" target="_blank">
                            <img src="{{ asset($image) }}" alt="Current {{ $label }}"
                                class="w-full h-full object-cover">
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>


<script>
    function removeImage(button, imagePath) {
        index = $(button).data('index');
        url = @json(route($routeName . '.delete', [':id', ':imageIndex']));

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#b1b1b0',
            confirmButtonText: 'Yes, remove it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                const pathParts = window.location.pathname.split('/')
                url = url.replace(':id', pathParts[2]).replace(':imageIndex', index);

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    type: "DELETE",
                    url: url,
                    success: function(response) {
                        if (response.status == true) {
                            button.parentElement.remove();

                            currentName = @json($currentName);
                            $('#' + currentName + '_value').val(response.images);

                            successToast(response.message);
                        } else {
                            errorToast(response.message);
                        }
                    },
                    error: function() {
                        errorToast(
                            'Sorry, there was some issue. Please try again!!'
                        );
                    }
                });
            }
        });
    }
</script>
