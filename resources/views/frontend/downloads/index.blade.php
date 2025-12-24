@extends('frontend.layouts.app')

@section('title', 'Downloads')

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.download'),
        'subHeading' => __('pages.download_tagline'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.download'),
            'route' => route('downloads'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <div class="md:flex m-8">
        @if (!$downloadCategories->isEmpty())
            <div class="md:hidden">
                <select id="download-category-sm"
                    class="block w-full px-3 py-2 border rounded-md shadow-sm bg-white focus:ring-primary focus:border-primary capitalize mb-4">
                    @foreach ($downloadCategories as $key => $downloadCategory)
                        <option value="{{ $key }}">
                            {{ app()->getLocale() == 'en' ? $downloadCategory->name_en : (isset($downloadCategory->name_np) ? $downloadCategory->name_np : $downloadCategory->name_en) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <ul class="hidden md:flex h-96 overflow-auto flex-col space-y-4 text-sm font-medium md:me-4 mb-4 md:mb-0 w-1/4">
                <h2 class="px-4 py-2 text-xl text-primary font-semibold">{{ __('pages.download_filter') }}</h2>

                @foreach ($downloadCategories as $key => $downloadCategory)
                    <li data-id="{{ $key }}" id="download-category-{{ $key }}"
                        class="inline-flex items-center px-4 py-3 rounded-lg w-full hover:bg-secondary/20 hover:text-black download-category cursor-pointer {{ $key == 0 ? 'bg-primary text-white' : 'bg-gray-50' }}">
                        {{ app()->getLocale() == 'en' ? $downloadCategory->name_en : (isset($downloadCategory->name_np) ? $downloadCategory->name_np : $downloadCategory->name_en) }}
                    </li>
                @endforeach
            </ul>

            <div class="h-96 overflow-auto p-6 bg-gray-50 text-medium text-gray-500 rounded-lg w-full"
                id="downloadContentDiv">
                @foreach ($downloadCategories as $key => $downloadCategory)
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 {{ $key == 0 ? '' : 'hidden' }} download"
                        id="download-{{ $key }}">

                        <!-- Category Title -->
                        <div class="text-primary font-bold text-xl capitalize col-span-full md:col-span-3">
                            {{ app()->getLocale() == 'en' ? $downloadCategory->name_en : (isset($downloadCategory->name_np) ? $downloadCategory->name_np : $downloadCategory->name_en) }}
                        </div>

                        @forelse ($downloadCategory->downloads as $download)
                            <div x-data="{
                                hover: false,
                                isMobile: window.innerWidth < 768,
                                fileType: (() => {
                                    const file = '{{ $download->file }}';
                                    if (file.endsWith('.pdf')) return 'pdf';
                                    if (file.endsWith('.docx') || file.endsWith('.doc')) return 'word';
                                    if (file.endsWith('.xls') || file.endsWith('.xlsx')) return 'excel';
                                    if (file.endsWith('.jpg') || file.endsWith('.png')) return 'image';
                                    if (file.endsWith('.zip') || file.endsWith('.rar')) return 'archive';
                                    return 'default';
                                })()
                            }" @mouseenter="if(!isMobile) hover = true"
                                @mouseleave="if(!isMobile) hover = false"
                                @click="if(isMobile) window.location.href='{{ asset($download->file) }}'"
                                class="relative w-full p-6 bg-white border border-gray-200 rounded-lg shadow-lg hover:shadow-2xl transition duration-300 ease-in-out transform hover:scale-105 overflow-hidden cursor-pointer">

                                <!-- Main Content -->
                                <div class="flex items-center mb-4">
                                    <i
                                        :class="{
                                            'fas fa-file-pdf text-red-500 text-3xl': fileType === 'pdf',
                                            'fas fa-file-word text-blue-500 text-3xl': fileType === 'word',
                                            'fas fa-file-excel text-green-500 text-3xl': fileType === 'excel',
                                            'fas fa-file-image text-green-500 text-3xl': fileType === 'image',
                                            'fas fa-file-archive text-yellow-500 text-3xl': fileType === 'archive',
                                            'fas fa-file-alt text-gray-500 text-3xl': fileType === 'default'
                                        }"></i>

                                    <h5 class="ml-4 text-xl font-bold text-secondary">
                                        {{ app()->getLocale() == 'en' ? $download->name_en : (isset($download->name_np) ? $download->name_np : $download->name_en) }}
                                    </h5>
                                </div>

                                <!-- Hover Overlay (Desktop Only) -->
                                <div x-show="hover && !isMobile" x-transition.opacity
                                    class="absolute inset-0 bg-black/50 flex items-center justify-center rounded-lg">
                                    <a href="{{ asset($download->file) }}" download
                                        class="bg-secondary text-white px-5 py-2 rounded-lg text-lg font-semibold hover:bg-[#024a3a] transition">
                                        <i class="fas fa-download mr-2"></i> {{ __('pages.download') }}
                                    </a>
                                </div>

                            </div>
                        @empty
                            <!-- No Downloads Message -->
                            <div class="col-span-full text-center flex flex-col items-center justify-center h-64">
                                <h3 class="text-lg text-primary mb-4 hover:text-secondary">
                                    {{ __('pages.no_download') }}
                                </h3>
                            </div>
                        @endforelse
                    </div>
                @endforeach
            </div>
        @else
            <div class="w-full text-center flex flex-col items-center justify-center h-64">
                <h3 class="text-lg text-primary mb-4 hover:text-secondary">
                    {{ __('pages.no_download') }}
                </h3>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.download-category', function() {
            index = $(this).data('id');
            const $el = $(this);

            $el.removeClass('hover:bg-secondary/20 hover:text-black');
            setTimeout(() => {
                $el.addClass('hover:bg-secondary/20 hover:text-black');
            }, 2000);

            downloadContent(index);
        });

        $(document).on('click', '#download-category-sm', function() {
            index = $(this).val();
            downloadContent(index);
        });

        function downloadContent(index) {
            $('.download-category').removeClass('bg-primary text-white').addClass('bg-gray-50');
            $('#download-category-' + index).removeClass('bg-gray-50').addClass('bg-primary text-white');

            $('.download').addClass('hidden');
            $('#download-' + index).removeClass('hidden');

            var target = $("#download-" + index);
            var container = $('#downloadContentDiv');

            container.animate({
                scrollTop: container.scrollTop() + target.offset().top - container.offset().top
            }, 500);
        }
    </script>
@endsection
