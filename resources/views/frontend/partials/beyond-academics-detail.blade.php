@extends('frontend.layouts.app')

@section('title', $data->name_en)

@php
    use App\Helpers\Helper;
@endphp

@section('content')
    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.main_heading_' . $route1),
        'subHeading' => __('pages.sub_heading_' . $route1),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.' . $route1),
            'route' => route($route1),
        ],
        'breadcrumb3' => [
            'name' =>
                app()->getLocale() == 'en'
                    ? $data->name_en
                    : (isset($data->name_np)
                        ? $data->name_np
                        : $data->name_en),
            'route' => route($route2, $data->slug),
            'class' => 'text-gray-400',
        ],
        'breadcrumb4' => null,
    ])

    {{-- Main Content --}}
    <section class="my-12 lg:my-24 px-6 md:px-10 lg:px-20 xl:px-20">
        <div class="flex flex-col lg:flex-row gap-10">
            {{-- Left Section (80%) --}}
            <div class="w-full lg:w-3/5">
                <!-- Article Header -->
                @isset($data)
                    <header class="mb-8 border-b pb-4">
                        <h1 class="text-3xl sm:text-4xl font-bold text-primary leading-snug">
                            <i class="{{ isset($data->icon) ? $data->icon : '' }}"></i>

                            {{ app()->getLocale() == 'en' ? $data->name_en : (isset($data->name_np) ? $data->name_np : $data->name_en) }}

                        </h1>
                    </header>

                    <!-- Short Description -->
                    <section class="mb-6">
                        <p class="text-lg text-gray-700 font-medium border-l-4 border-primary pl-4">
                            {{ app()->getLocale() == 'en' ? $data->short_description_en : (isset($data->short_description_np) ? $data->short_description_np : $data->short_description_en) }}

                        </p>
                    </section>

                    <!-- Long Description -->
                    <article class="space-y-6 text-gray-700 text-justify leading-relaxed">
                        {!! Helper::stripInlineStyle(
                            app()->getLocale() === 'en' ? $data->description_en : $data->description_np ?? $data->description_en,
                        ) !!}
                    </article>

                    <!-- Featured Image -->
                    @php
                        $images = is_array($data->images) ? $data->images : json_decode($data->images, true);
                    @endphp

                    @if (!empty($images))
                        <div x-data="{
                            imageGalleryOpened: false,
                            imageGalleryActiveUrl: null,
                            imageGalleryImageIndex: null,
                            imageGallery: [
                                @foreach ($images as $index => $image)
                                    {
                                    photo: '{{ asset($image) }}',
                                    alt: 'Club Image {{ $index + 1 }}'
                                    }
                                    @if (!$loop->last),@endif @endforeach
                            ],
                            imageGalleryOpen(event) {
                                this.imageGalleryImageIndex = event.target.dataset.index;
                                this.imageGalleryActiveUrl = event.target.src;
                                this.imageGalleryOpened = true;
                            },
                            imageGalleryClose() {
                                this.imageGalleryOpened = false;
                                setTimeout(() => this.imageGalleryActiveUrl = null, 300);
                            },
                            imageGalleryNext() {
                                this.imageGalleryImageIndex = (this.imageGalleryImageIndex == this.imageGallery.length) ? 1 : (parseInt(this.imageGalleryImageIndex) + 1);
                                this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
                            },
                            imageGalleryPrev() {
                                this.imageGalleryImageIndex = (this.imageGalleryImageIndex == 1) ? this.imageGallery.length : (parseInt(this.imageGalleryImageIndex) - 1);
                                this.imageGalleryActiveUrl = this.$refs.gallery.querySelector('[data-index=\'' + this.imageGalleryImageIndex + '\']').src;
                            }
                        }" @image-gallery-next.window="imageGalleryNext()"
                            @image-gallery-prev.window="imageGalleryPrev()" @keyup.right.window="imageGalleryNext();">
                            <!-- Club Images Grid -->
                            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-4 gap-4" x-ref="gallery"
                                id="gallery">
                                <template x-for="(image, index) in imageGallery" :key="index">
                                    <div>
                                        <img @click="imageGalleryOpen" :src="image.photo" :alt="image.alt"
                                            :data-index="index + 1"
                                            class="w-full h-[120px] sm:h-[140px] md:h-[160px] lg:h-[140px] object-cover rounded-xl shadow-md cursor-zoom-in hover:opacity-80 transition" />
                                    </div>
                                </template>
                            </div>

                            <!-- Lightbox -->
                            <template x-teleport="body">
                                <div x-show="imageGalleryOpened" x-transition:enter="transition ease-in-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:leave="transition ease-in-in duration-300"
                                    x-transition:leave-end="opacity-0" @click="imageGalleryClose"
                                    @keydown.window.escape="imageGalleryClose" x-trap.inert.noscroll="imageGalleryOpened"
                                    class="fixed inset-0 z-[99] flex items-center justify-center bg-black bg-opacity-60 select-none cursor-zoom-out"
                                    x-cloak>
                                    <div class="relative flex items-center justify-center w-11/12 xl:w-4/5 h-11/12">
                                        <!-- Prev -->
                                        <div @click="$event.stopPropagation(); $dispatch('image-gallery-prev')"
                                            class="absolute left-0 flex items-center justify-center text-white bg-white/10 hover:bg-white/20 rounded-full cursor-pointer w-12 h-12 -translate-x-10">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.75 19.5L8.25 12l7.5-7.5" />
                                            </svg>
                                        </div>

                                        <!-- Active Image -->
                                        <img x-show="imageGalleryOpened"
                                            x-transition:enter="transition ease-in-out duration-300"
                                            x-transition:enter-start="opacity-0 transform scale-50"
                                            x-transition:leave="transition ease-in-in duration-300"
                                            x-transition:leave-end="opacity-0 transform scale-50"
                                            class="object-contain max-w-[90%] max-h-[80vh] cursor-zoom-out"
                                            :src="imageGalleryActiveUrl" alt="" />

                                        <!-- Next -->
                                        <div @click="$event.stopPropagation(); $dispatch('image-gallery-next')"
                                            class="absolute right-0 flex items-center justify-center text-white bg-white/10 hover:bg-white/20 rounded-full cursor-pointer w-12 h-12 translate-x-10">
                                            <svg class="w-6 h-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M8.25 4.5l7.5 7.5-7.5 7.5" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>
                    @endif
                @endisset
            </div>

            {{-- Right Section (20%) --}}
            <div class="w-full lg:w-2/5 flex flex-col gap-6">
                {{-- About Section --}}
                @include('frontend.partials.about-section', ['socials' => $setting])

                {{-- Explore Button --}}
                <a href="{{ route($route1) }}"
                    class="self-end bg-secondary text-white font-semibold text-center px-4 py-2 rounded-full hover:bg-primary transition">
                    {{ __('pages.explore_' . $route1) }}
                </a>

                {{-- News List --}}
                <div class="drop-shadow-lg bg-white rounded-lg">
                    <div class="flex items-center gap-3 p-3 border-b">
                        <i class="fa fa-list text-primary"></i>
                        <h2 class="font-bold text-base text-primary">{{ __('pages.other_' . $route1) }}</h2>
                    </div>

                    <div class="overflow-y-auto max-h-[430px] p-3 space-y-3">
                        @foreach ($allDatas as $allData)
                            <a href="{{ route($route2, $allData->slug) }}"
                                class="flex gap-3 p-2 border-l-4 border-primary rounded-md hover:bg-gray-50 transition">
                                <img src="{{ asset($allData->thumbnail_image) }}" alt="GBBS"
                                    class="w-20 h-16 rounded-md object-cover flex-shrink-0" />
                                <div>
                                    <div class="font-semibold text-sm hover:text-primary transition line-clamp-2">
                                        {{ app()->getLocale() == 'en' ? $allData->name_en : (isset($allData->name_np) ? $allData->name_np : $allData->name_en) }}
                                    </div>

                                    <div class="text-gray-500 text-xs mt-1">
                                        {!! Helper::stripInlineStyle(
                                            app()->getLocale() == 'en'
                                                ? $allData->short_description_en ?? ''
                                                : $allData->short_description_np ?? ($allData->short_description_en ?? ''),
                                        ) !!}
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
