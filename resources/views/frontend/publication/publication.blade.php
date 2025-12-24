@extends('frontend.layouts.app')

@section('title', 'Publication')

@php
    use Carbon\Carbon;
    use App\Helpers\Helper;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.publications'),
        'subHeading' => __('pages.publications_tagline'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.publication'),
            'route' => route('publication'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <!-- ============================= -->
    <!-- 📘 A Section -->
    <!-- ============================= -->

    <section class="md:flex m-8">
        @if (!$publicationCategories->isEmpty())
            <div class="md:hidden">
                <select id="publication-category-sm"
                    class="block w-full px-3 py-2 border rounded-md shadow-sm bg-white focus:ring-blue-500 focus:border-blue-500 capitalize mb-4">
                    @foreach ($publicationCategories as $key => $publicationCategory)
                        <option value="{{ $key }}">
                            {{ app()->getLocale() == 'en' ? $publicationCategory->name_en : (isset($publicationCategory->name_np) ? $publicationCategory->name_np : $publicationCategory->name_en) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sidebar for categories (desktop) -->
            <ul class="hidden md:flex h-96 overflow-auto flex-col space-y-4 text-sm font-medium md:me-4 mb-4 md:mb-0 w-1/4">
                <h2 class="px-4 py-2 text-xl text-primary font-semibold">{{ __('pages.publication_filter') }}</h2>
                @foreach ($publicationCategories as $key => $publicationCategory)
                    <li data-id="{{ $key }}" id="publication-category-{{ $key }}"
                        class="inline-flex items-center px-4 py-3 rounded-lg w-full hover:bg-secondary/20 hover:text-black publication-category cursor-pointer bg-gray-50 text-gray-800 fw-bold">
                        {{ app()->getLocale() == 'en' ? $publicationCategory->name_en : $publicationCategory->name_np ?? $publicationCategory->name_en }}
                    </li>
                @endforeach
            </ul>

            <!-- Publications Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 flex-1 pr-6" id="publications-container">

                @foreach ($publicationCategories as $key => $publicationCategory)
                    @php
                        $publications = $publicationCategory->publications;
                    @endphp

                    @if ($publications->isEmpty())
                        <p class="text-gray-500 animate-slideUp publication-card" data-category="{{ $key }}">
                            {{ __('pages.no_details') }}
                        </p>
                    @else
                        @foreach ($publications as $publication)
                            <div class="bg-white rounded-2xl shadow-md p-4 flex gap-4 group animate-slideUp publication-card"
                                data-category="{{ $key }}">

                                <div class="overflow-hidden rounded-xl w-50 h-40">
                                    <img src="{{ $publication->thumbnail_image }}"
                                        class="w-full h-full object-cover rounded-xl transition-transform duration-500 group-hover:scale-110"
                                        alt="Image">
                                </div>

                                <div class="flex flex-col justify-between w-full">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-800">
                                            {{ app()->getLocale() == 'en' ? $publication->name_en : $publication->name_np ?? $publication->name_en }}
                                        </h3>

                                        <div class="flex items-center text-sm text-gray-500 mt-4">
                                            <span class="flex gap-2">
                                                <i class="fa-regular fa-calendar"></i>
                                                {{ app()->getLocale() == 'en'
                                                    ? $publication->published_date
                                                    : LaravelNepaliDate::from($publication->published_date)->toNepaliDate(format: 'j F Y', locale: 'np') }}
                                            </span>

                                            @isset($publication->author)
                                                <span class="flex gap-2 ml-auto">
                                                    <i class="fa-solid fa-user"></i> {{ $publication->author }}
                                                </span>
                                            @endisset
                                        </div>

                                        <p class="mt-6 text-gray-600 text-sm line-clamp-2">
                                            {!! Helper::stripInlineStyle(
                                                app()->getLocale() == 'en'
                                                    ? $publication->short_description_en ?? ''
                                                    : $publication->short_description_np ?? ($publication->short_description_en ?? ''),
                                            ) !!}
                                        </p>
                                    </div>

                                    <a href="{{ route('publication-detail', $publication->slug) }}"
                                        class="text-[#205246] text-md mt-3 flex items-center gap-1 font-medium group-hover:text-secondary">
                                        {{ __('pages.read_more') }} <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach

            </div>
        @else
            <div class="w-full text-center flex flex-col items-center justify-center h-64">
                <h3 class="text-lg text-primary mb-4 hover:text-secondary">
                    {{ __('pages.no_details') }}
                </h3>
            </div>
        @endif
    </section>
@endsection

@section('scripts')
    <script>
        const categories = document.querySelectorAll('.publication-category');
        const categorySelect = document.getElementById('publication-category-sm');
        const publications = document.querySelectorAll('.publication-card');

        //  Show only first category on page load
        if (categories.length > 0) {
            const firstId = categories[0].getAttribute('data-id');

            publications.forEach(pub => {
                pub.style.display = pub.getAttribute('data-category') === firstId ? 'flex' : 'none';
            });

            categories[0].classList.add('bg-primary', 'text-white');
            categories[0].classList.remove('bg-gray-50', 'text-gray-800');
        }

        //  Category click filter
        categories.forEach(category => {
            category.addEventListener('click', () => {
                const selectedId = category.getAttribute('data-id');

                // Update active class
                categories.forEach(cat => {
                    cat.classList.remove('bg-primary', 'text-white');
                    cat.classList.add('bg-gray-50', 'text-gray-800');
                });
                category.classList.add('bg-primary', 'text-white');
                category.classList.remove('bg-gray-50', 'text-gray-800');

                // Show/hide publications
                publications.forEach(pub => {
                    pub.style.display = pub.getAttribute('data-category') === selectedId ? 'flex' :
                        'none';
                });
            });
        });

        categorySelect.addEventListener('change', () => {
            const selectedId = categorySelect.value;

            // Show/hide publications based on selected category
            publications.forEach(pub => {
                if (pub.getAttribute('data-category') === selectedId) {
                    pub.style.display = 'flex'; // or 'block'
                } else {
                    pub.style.display = 'none';
                }
            });
        });
    </script>
@endsection
