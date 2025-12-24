@extends('frontend.layouts.app')

@section('title', 'Quick Links')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.quick_link'),
        'subHeading' => __('pages.quick_link_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.quick_link'),
            'route' => route('quick-link'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Quick Links Section --}}
    <section class="mb-12 flex justify-center px-4">
        <div class="w-full max-w-6xl p-6 sm:p-8 md:p-10 flex flex-col space-y-8">

            @php
                // Flatten grouped quickLinks into a single collection/array
                $allLinks = collect([]);
                if (!empty($quickLinks) && $quickLinks->isNotEmpty()) {
                    foreach ($quickLinks as $group) {
                        // if group is array or collection
                        $allLinks = $allLinks->merge(collect($group));
                    }
                }
            @endphp

            @if ($allLinks->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($allLinks as $link)
                        <a href="{{ $link->menu ? url($link->menu->slug) : $link->url }}" target="_blank"
                            class="block h-[60px] border border-gray-300 rounded-lg
                                hover:bg-gradient-to-r from-primary to-secondary
                                text-base sm:text-lg md:text-xl font-semibold px-5 py-3
                                flex items-center text-gray-900 hover:text-white
                                border-b-4 border-[#005aab] transition-all duration-300">
                            <i class="fas fa-arrow-right text-sm mr-3" aria-hidden="true"></i>
                            <span class="line-clamp-2">
                                {{ app()->getLocale() == 'en' ? $link->name_en ?? $link->name : $link->name_np ?? ($link->name_en ?? $link->name) }}
                            </span>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-center">
                    {{ app()->getLocale() == 'en' ? 'No quick links available.' : 'कुनै छिटो लिंक उपलब्ध छैन।' }}
                </p>
            @endif
        </div>
    </section>

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
