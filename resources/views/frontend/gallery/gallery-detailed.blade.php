@extends('frontend.layouts.app')

@section('title', $gallery->name_en ?? 'Gallery Detail')

@push('styles')
@endpush

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' =>
            app()->getLocale() == 'en'
                ? $gallery->name_en
                : (isset($gallery->name_np)
                    ? $gallery->name_np
                    : $gallery->name_en),
        'subHeading' => __('pages.gallery_sub_heading'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.gallery'),
            'route' => route('gallery'),
        ],
        'breadcrumb3' => [
            'name' =>
                app()->getLocale() == 'en'
                    ? $gallery->name_en
                    : (isset($gallery->name_np)
                        ? $gallery->name_np
                        : $gallery->name_en),
            'route' => route('gallery-detail', $gallery->slug),
            'class' => 'text-gray-400',
        ],
        'breadcrumb4' => null,
    ])

    {{-- Main Section --}}
    <section class="my-12 lg:my-20 px-6 md:px-10 lg:px-20 xl:px-40">
        {{-- Title & Description --}}
        <div class="mb-8 text-center">
            <p class="text-gray-600 leading-relaxed max-w-4xl mx-auto">
                {{ app()->getLocale() == 'en' ? $gallery->description_en : (isset($gallery->description_np) ? $gallery->description_np : $gallery->description_en) }}
            </p>
        </div>

        {{-- IMAGE GALLERY --}}
        @if ($gallery->type === \App\Enum\GalleryTypeEnum::IMAGE->value)
            <div x-data="{
                open: false,
                activeIndex: 0,
                images: [
                    @if ($gallery->cover_image) '{{ asset($gallery->cover_image) }}', @endif
                    @if ($gallery->value) @foreach (json_decode($gallery->value) as $image)
                                    '{{ asset($image) }}',
                                @endforeach @endif
                ],
                openImage(index) {
                    this.activeIndex = index;
                    this.open = true;
                },
                closeImage() {
                    this.open = false;
                },
                nextImage() {
                    this.activeIndex = (this.activeIndex + 1) % this.images.length;
                },
                prevImage() {
                    this.activeIndex = (this.activeIndex - 1 + this.images.length) % this.images.length;
                }
            }" class="relative">
                <div class="columns-1 sm:columns-2 lg:columns-3 xl:columns-4 gap-5 space-y-5">
                    <template x-for="(image, index) in images" :key="index">
                        <div class="break-inside-avoid cursor-pointer">
                            <img :src="image" alt="Gallery Image" @click="openImage(index)"
                                class="max-w-full h-auto rounded-2xl object-cover transition hover:opacity-90 hover:scale-[1.01]" />
                        </div>
                    </template>
                </div>


                <!-- Lightbox -->
                <div x-show="open" x-transition
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm">
                    <div class="relative max-w-6xl w-full px-6">
                        <button @click="closeImage"
                            class="absolute top-4 right-6 text-white text-4xl font-bold hover:text-gray-300 transition">
                            &times;
                        </button>

                        <button @click="prevImage"
                            class="absolute left-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold px-3 py-2 bg-black/40 hover:bg-black/60 rounded-full">
                            &#10094;
                        </button>

                        <img :src="images[activeIndex]"
                            class="rounded-lg object-contain w-full max-h-[90vh] mx-auto transition-all duration-300" />

                        <button @click="nextImage"
                            class="absolute right-4 top-1/2 -translate-y-1/2 text-white text-4xl font-bold px-3 py-2 bg-black/40 hover:bg-black/60 rounded-full">
                            &#10095;
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- VIDEO GALLERY --}}
        @if ($gallery->type === \App\Enum\GalleryTypeEnum::VIDEO->value)
            <div class="flex justify-center mt-8">
                <div class="aspect-w-16 aspect-h-9 w-full max-w-4xl">
                    <iframe class="w-full h-[500px] rounded-lg shadow-md" src="{{ $gallery->value }}" title="Video Gallery"
                        allowfullscreen></iframe>
                </div>
            </div>
        @endif
    </section>
@endsection
