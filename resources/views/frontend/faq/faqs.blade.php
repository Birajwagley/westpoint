@extends('frontend.layouts.app')

@section('title', 'FAQs')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.faq'),
        'subHeading' => __('pages.faq_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.faq'),
            'route' => route('faqs'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <!-- FAQ Layout -->
    <div class="flex justify-center">
        <div class="m-6 sm:m-12 grid grid-cols-1 lg:grid-cols-4 gap-6 max-w-7xl w-full">
            <!-- Mobile Dropdown -->
            <div class="block lg:hidden mb-4">
                <label for="faqDropdown" class="sr-only">
                    {{ app()->getLocale() == 'en' ? 'Select FAQ Category' : 'FAQ श्रेणी चयन गर्नुहोस्' }}
                </label>
                <select id="faqDropdown"
                    class="w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-2 focus:ring-brandBlue focus:outline-none">
                    @foreach ($faqCategories as $faqCategory)
                        <option value="{{ $faqCategory->id }}">
                            {{ app()->getLocale() == 'en' ? $faqCategory->name_en : $faqCategory->name_np ?? $faqCategory->name_en }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sidebar Category List for Desktop -->
            <div class="hidden lg:block lg:col-span-1 space-y-2">
                @foreach ($faqCategories as $faqCategory)
                    @php $tabId = str_replace(' ', '', $faqCategory->name_en); @endphp
                    <div id="{{ $tabId }}-content">
                        <div class="p-1 rounded-lg bg-gray-50" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
                            <div class="mx-auto w-full">
                                <span id="faq-{{ $faqCategory->id }}" data-id="{{ $faqCategory->id }}"
                                    class="faq-category block p-4 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 cursor-pointer transition">
                                    <div class="flex items-center">
                                        <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.125 8.875C10.125 7.83947 10.9645 7 12 7C13.0355 7 13.875 7.83947 13.875 8.875C13.875 9.56245 13.505 10.1635 12.9534 10.4899C12.478 10.7711 12 11.1977 12 11.75V13"
                                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                            <circle cx="12" cy="16" r="1" fill="#1C274C"></circle>
                                            <path
                                                d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8"
                                                stroke="#1C274C" stroke-width="1.5" stroke-linecap="round"></path>
                                        </svg>
                                        <h5 class="pl-2 text-lg font-bold tracking-tight text-gray-900 line-clamp-1">
                                            {{ app()->getLocale() == 'en' ? $faqCategory->name_en : $faqCategory->name_np ?? $faqCategory->name_en }}
                                        </h5>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- FAQ Content -->
            <div class="lg:col-span-3 faq-content">
                <div class="text-center text-gray-500 py-10">
                    {{ app()->getLocale() == 'en' ? 'Select a category to view FAQs.' : 'FAQ हेर्नको लागि कुनै श्रेणी छान्नुहोस्।' }}
                </div>
            </div>
        </div>
    </div>

    {{-- Contact Details --}}
    @include('frontend.partials.contact-detail')
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Load first category on page load
            getFaq($('#faqDropdown').val() || 1);

            // Dropdown change event (Mobile)
            $('#faqDropdown').on('change', function() {
                getFaq($(this).val());
            });

            // Sidebar click event (Desktop)
            $('.faq-category').on('click', function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                getFaq(id);

                // Highlight active category
                $('.faq-category').removeClass('bg-brandBlue text-white');
                $(this).addClass('bg-brandBlue text-white');
            });

            // AJAX loader for FAQs
            function getFaq(id) {
                let faqUrl = "{{ route('get-faq', ':id') }}".replace(":id", id);
                $.ajax({
                    type: "GET",
                    url: faqUrl,
                    success: function(response) {
                        $('.faq-content').html(response);
                    },
                    error: function() {
                        $('.faq-content').html(
                            '<p class="text-center text-red-500 mt-10">Failed to load FAQs.</p>');
                    }
                });
            }
        });
    </script>
@endpush
