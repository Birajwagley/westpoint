@extends('frontend.layouts.app')

@section('title', 'Gallery')

@push('styles')
@endpush

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.gallery_main_heading'),
        'subHeading' => __('pages.gallery_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.gallery'),
            'route' => route('gallery'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    {{-- Image Gallery Section --}}
    <section class="lg:my-20 px-6 md:px-10 lg:px-20 xl:px-40">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 border-b pb-3 border-gray-200">
            {{ __('pages.image_gallery') }}
        </h2>

        @if ($imageGalleries->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($imageGalleries as $gallery)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <a href="{{ route('gallery-detail', $gallery->slug) }}">
                            <img class="w-full h-48 object-cover"
                                src="{{ $gallery->cover_image ? asset($gallery->cover_image) : asset('assets/images/placeholder.jpg') }}"
                                alt="{{ app()->getLocale() === 'np' ? $gallery->name_np : $gallery->name_en }}">
                        </a>
                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                {{ app()->getLocale() === 'np' ? $gallery->name_np : $gallery->name_en }}
                            </h3>
                            <a href="{{ route('gallery-detail', $gallery->slug) }}"
                                class="text-sm bg-primary text-white py-1.5 px-4 rounded-full hover:bg-primary/90 transition">
                                <i class="fa-regular fa-eye mr-1"></i> {{ __('pages.view_more') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-center text-gray-600 mt-6">{{ __('pages.no_image_data') }}</p>
        @endif
    </section>

    {{-- Video Gallery Section --}}
    <section class="my-10 py-5 lg:my-20 px-6 md:px-10 lg:px-20 xl:px-40 bg-gray-50">
        <h2 class="text-2xl sm:text-3xl font-bold text-center mb-8 border-b pb-3 border-gray-200">
            {{ __('pages.video_gallery') }}
        </h2>

        @if ($videoGalleries->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($videoGalleries as $gallery)
                    <div class="bg-white rounded-lg shadow hover:shadow-lg transition overflow-hidden">
                        <div class="relative w-full h-48">
                            <!-- Thumbnail -->
                            <img class="w-full h-full object-cover rounded-t-lg"
                                src="{{ $gallery->cover_image ? asset($gallery->cover_image) : asset('assets/images/placeholder.jpg') }}"
                                alt="Video Thumbnail" />

                            <!-- Watch Video Button Overlay -->
                            @if ($gallery->value)
                                <button
                                    class="absolute inset-0 flex items-center justify-center bg-black/40 hover:bg-black/50 transition rounded-t-lg"
                                    data-video-url="{{ $gallery->value }}" onclick="openVideoModal(this)">
                                    <span
                                        class="flex items-center gap-2 text-white font-semibold text-lg sm:text-xl  px-4 py-2 rounded-full shadow-md">
                                        <i class="fa-solid fa-circle-play fa-lg"></i>

                                    </span>
                                </button>
                            @endif
                        </div>

                        <div class="p-4 text-center">
                            <h3 class="text-lg font-semibold text-gray-800 mb-2">
                                {{ app()->getLocale() === 'np' ? $gallery->name_np : $gallery->name_en }}
                            </h3>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Modal -->
            <div id="videoGalleryModal" class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4">
                <div class="relative bg-white rounded-xl overflow-hidden shadow-lg w-full max-w-4xl">
                    <!-- Close Button -->
                    <button id="closeVideoGalleryModal"
                        class="absolute top-3 right-3 text-gray-700 hover:text-accent transition">
                        <i class="fa fa-times fa-xl"></i>
                    </button>

                    <!-- Video Frame -->
                    <div class="w-full h-0 relative pb-[56.25%]"> <!-- 16:9 aspect ratio -->
                        <iframe id="videoGalleryFrame" class="absolute top-0 left-0 w-full h-full rounded-lg" src=""
                            title="Video Player" allowfullscreen
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture">
                        </iframe>
                    </div>
                </div>
            </div>
        @else
            <p class="text-center text-gray-600 mt-6">{{ __('pages.no_video_data') }}</p>
        @endif
    </section>
@endsection

@push('scripts')
    <script>
        const videoModal = document.getElementById('videoGalleryModal');
        const videoFrame = document.getElementById('videoGalleryFrame');
        const closeModal = document.getElementById('closeVideoGalleryModal');

        function openVideoModal(button) {
            const url = button.dataset.videoUrl;
            if (!url) return;

            videoFrame.src = url + '?autoplay=1';
            videoModal.classList.remove('hidden');
        }

        closeModal.addEventListener('click', () => {
            videoModal.classList.add('hidden');
            videoFrame.src = '';
        });

        // Close modal if clicking outside the video
        videoModal.addEventListener('click', (e) => {
            if (e.target === videoModal) {
                videoModal.classList.add('hidden');
                videoFrame.src = '';
            }
        });
    </script>
@endpush
