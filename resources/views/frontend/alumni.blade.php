@extends('frontend.layouts.app')

@section('title', 'Alumni')

@section('styles')

@endsection

@section('content')
    <style>
        .emoji-flag {
            font-family: "Twemoji Mozilla", "Apple Color Emoji", "Segoe UI Emoji",
                "Noto Color Emoji", "EmojiOne Color", sans-serif !important;
        }

        /* Clip path for desktop hero image */
        @media (min-width: 650px) {
            .clip-lg {
                clip-path: polygon(20% 0, 100% 0, 100% 100%, 0% 100%);
            }
        }

        .swiper-slide {
            box-shadow: none;
        }

        .swiper-nav-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 9999px;
            /* full rounded */
            background-color: #03624C;
            color: #fff;
            font-size: 1.25rem;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            user-select: none;
        }

        .swiper-nav-btn:hover {
            background-color: #0A7C5E;
        }

        .swiper-nav-btn {
            width: 2.5rem;
            height: 2.5rem;
        }

        .button {
            display: flex;
            justify-content: center;
            color: #fff;
            width: 30px;
            height: 30px;
            border-radius: 100%;
            background: linear-gradient(30deg, rgb(255, 130, 0) 20%, rgb(255, 38, 0) 80%);
            transition: all 0.3s ease-in-out 0s;
            box-shadow: rgba(193, 244, 246, 0.698) 0px 0px 0px 0px;
            animation: 1.2s cubic-bezier(0.8, 0, 0, 1) 0s infinite normal none running pulse;
            align-items: center;
            border: 0;
        }

        .button:is(:hover, :focus) {
            transform: scale(1.2);
        }

        @keyframes pulse {
            100% {
                box-shadow: 0 0 0 45px rgba(193, 244, 246, 0);
            }
        }




        @media (min-width: 768px) {
            .swiper-nav-btn {
                width: 3rem;
                height: 3rem;
            }
        }

        @media (min-width: 1024px) {
            .swiper-nav-btn {
                width: 3.5rem;
                height: 3.5rem;
            }
        }
    </style>
    @php
        $alumni = \App\Models\Alumni::first(); // or pass $alumni from controller
        $backgroundImage = !empty($alumni->images)
            ? json_decode($alumni->images)[0]
            : 'assets/frontend/images/about-us/alumni.jpg';
    @endphp
    <section class="w-full h-[70vh] flex flex-col sm:flex-row items-center justify-between bg-[#044335] overflow-hidden">
        <div class="w-full sm:w-2/5 px-6 sm:px-12 py-12 sm:py-0 flex items-center">
            <div class="relative sm:left-20 flex flex-col space-y-5 text-center sm:text-left">
                <span class="text-white uppercase tracking-wide text-sm">{{ __('pages.alumni') }}</span>
                <h1 class="text-3xl sm:text-5xl font-bold text-white leading-tight">
                    {{ __('pages.gyanodaya') }} <span class="text-yellow-300">{{ __('pages.alumni_header') }}</span>
                </h1>
                <button href="#"
                    class="sm:w-4/5 lg:w- px-8 py-3 bg-white text-[#044335] rounded-full font-semibold shadow-md hover:bg-gray-200 transition-all duration-300 sm:mx-0">
                    {{ __('pages.alumni_button') }} </button>
            </div>
        </div>
        <div class="w-full sm:w-3/5 h-full min-h-[350px] clip-lg bg-cover bg-center"
            style="background-image: url('{{ asset($backgroundImage) }}');">
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-6 pt-16">
        <h1 class="text-3xl md:text-5xl font-bold text-center mb-6 leading-tight">
            {{ __('pages.gyanodaya') }} <span class="text-[#0A7C5E]">{{ __('pages.alumni_header') }}</span>
        </h1>

        <p class="text-center text-gray-600 leading-relaxed  max-w-3xl mx-auto text-sm md:text-base">
            {{ app()->getLocale() == 'en' ? $alumni->description_en : $alumni->description_np ?? $alumni->description_en }}
        </p>

        @php
            $primarySection = $sections['primary_section'] ?? collect();
        @endphp

        @if ($primarySection->count() > 0)
            <div class="swiper alumni-swiper">
                <div class="swiper-wrapper">

                    @foreach ($primarySection as $alumni)
                        @php
                            $companyLogo = $alumni->company_logo
                                ? asset($alumni->company_logo)
                                : asset('assets/backend/images/logo.png');

                            $testimonialImage = optional($alumni->testimonial)->image
                                ? asset($alumni->testimonial->image)
                                : asset('assets/backend/images/logo.png');
                        @endphp

                        <div class="swiper-slide">
                            <div class="relative max-w-4xl mx-auto">

                                <div
                                    class="bg-[#0A5447] rounded-lg px-4 py-6 sm:px-6 sm:py-8 md:px-6 md:py-6 text-white w-full sm:max-w-md md:max-w-4xl mx-auto">

                                    <!-- Mobile Company Logo -->
                                    <div class="md:hidden w-28 h-28 mx-auto mb-6 bg-white rounded-lg overflow-hidden">
                                        <img src="{{ $companyLogo }}" class="w-full h-full object-cover">
                                    </div>

                                    <div class="flex flex-col md:flex-row">

                                        <!-- Desktop Left Company Logo -->
                                        <div
                                            class="hidden md:block absolute -left-8 top-24 w-52 h-52 bg-white rounded-lg overflow-hidden">
                                            <img src="{{ $companyLogo }}" class="w-full h-full object-cover">
                                        </div>

                                        <div class="md:ml-60">

                                            <!-- Right Testimonial Image -->
                                            <div class="flex justify-end mb-4">
                                                <div
                                                    class="bg-white rounded-full p-2 w-14 h-14 md:w-20 md:h-20 flex items-center justify-center">
                                                    <img src="{{ $testimonialImage }}"
                                                        class="w-full h-full object-contain">
                                                </div>
                                            </div>

                                            <h2
                                                class="text-xl md:text-3xl font-bold text-[#FDB913] flex items-center gap-4">
                                                {{ $alumni->full_name }}

                                                @if (!empty(optional($alumni->testimonial)->testimonial_video))
                                                    <button
                                                        class="button flex items-center justify-center w-8 h-8 bg-[#FDB913] text-white rounded-full hover:bg-yellow-400 transition-colors"
                                                        onclick="openVideoModal(`{!! optional($alumni->testimonial)->testimonial_video ?? '' !!}`)">
                                                        <svg viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"
                                                            width="16" height="16" aria-hidden="true">
                                                            <path fill="currentColor"
                                                                d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z" />
                                                        </svg>
                                                    </button>
                                                @endif
                                            </h2>

                                            <!-- VIDEO MODAL -->
                                            <div id="videoGalleryModal"
                                                class="hidden fixed inset-0 bg-black/70 z-50 flex items-center justify-center p-4"
                                                onclick="closeVideoModal()">

                                                <div class="relative w-full max-w-4xl bg-black rounded-xl overflow-hidden shadow-lg"
                                                    onclick="event.stopPropagation()">

                                                    <!-- Close Button -->
                                                    <button id="closeVideoGalleryModal"
                                                        class="absolute top-4 right-4 bg-red-600 text-white w-10 h-10 rounded-full flex items-center justify-center text-3xl font-bold hover:bg-red-700 transition">
                                                        &times;
                                                    </button>

                                                    <!-- Video Frame -->
                                                    <div class="w-full h-full relative aspect-video">
                                                        <iframe id="videoGalleryFrame" src="" title="Video Player"
                                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                                            allowfullscreen
                                                            class="absolute top-0 left-0 w-full h-full rounded-xl"></iframe>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-base md:text-lg flex items-center gap-2 mt-1">
                                                {{ $alumni->designation }} {{ __('pages.at') }} {{ $alumni->occupation }}

                                                @if ($alumni->country)
                                                    <span class="emoji-flag flex items-center gap-2">
                                                        {{ countries()[$alumni->country]['emoji'] }}
                                                        {{-- {{ app()->getLocale() == 'en'
                                                            ? countries()[$alumni->country]['name']
                                                            : Helper::getNepaliCountryName($alumni->country) }} --}}
                                                    </span>
                                                @endif
                                            </p>

                                            <p class="text-sm mb-4">{{ __('pages.batch_of') }} {{ $alumni->batch }}</p>

                                            <!-- TESTIMONIAL TEXT -->
                                            <div x-data="{ open: false }" class="mt-4 md:mt-2">
                                                <p class="text-sm md:text-base leading-relaxed overflow-hidden transition-all duration-300"
                                                    :class="open ? 'max-h-full' : 'max-h-[7.5rem]'">
                                                    {!! optional($alumni->testimonial)->testimonial_text ?? 'No testimonial available.' !!}
                                                </p>

                                                <button @click="open = !open"
                                                    class="text-[#FDB913] font-semibold mt-2 text-sm focus:outline-none">
                                                    <span
                                                        x-text="open ? '{{ __('pages.read_less') }}' : '{{ __('pages.read_more') }}'"></span>
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>

                <!-- Swiper Navigation Buttons -->
                <div class="flex flex-row items-center justify-center w-full lg:w-auto space-x-4 mt-4">
                    <span class="alumni-swiper-button-prev-custom swiper-nav-btn">&lt;</span>
                    <span class="alumni-swiper-button-next-custom swiper-nav-btn">&gt;</span>
                </div>
            </div>
        @endif

    </section>


    <!-- ================= ALUMNI PROFILE SWIPER ================= -->
    <div id="alumni-profile" class="h-auto bg-white w-full font-poppins">
        <div class="flex flex-col w-full px-4 sm:px-8 md:px-16 lg:px-28 py-10 space-y-14">

            <!-- Section Title -->
            <div class="text-center">
                <span class="w-12 h-[2px] bg-[#044335] inline-block"></span>
                <span class="text-black font-medium text-xl mx-3">{{ __('pages.alumni_profile') }}</span>
                <span class="w-12 h-[2px] bg-[#044335] inline-block"></span>
            </div>

            @php
                $secondarySection = $sections['secondary_section'] ?? collect();
            @endphp

            <div class="swiper profile-swiper overflow-hidden w-full p-2">
                <div class="swiper-wrapper py-6">

                    @foreach ($secondarySection as $alumni)
                        <div
                            class="swiper-slide w-72 h-auto bg-[#044335] rounded-xl shadow-lg mx-auto flex flex-col items-start justify-start p-4">

                            @php
                                $profileImage = $alumni->company_logo
                                    ? asset($alumni->company_logo)
                                    : asset('assets/backend/images/logo.png');
                            @endphp

                            <img src="{{ $profileImage }}" alt="alumni" class="w-32 h-32 rounded-full mt-4">

                            <p class="text-[#FFF32F] font-medium mt-6">
                                {{ $alumni->full_name }}
                            </p>

                            <p class="text-white font-medium">
                                {{ __('pages.batch') }}: {{ $alumni->batch }}
                            </p>

                            <div x-data="{ open: false }" class="mt-4 w-full">
                                <div class="overflow-hidden transition-all duration-500"
                                    :class="open ? 'max-h-[60rem]' : 'max-h-[7.5rem]'">
                                    <p class="text-white text-sm md:text-base leading-relaxed">
                                        {!! optional($alumni->testimonial)->testimonial_text ?? 'No testimonial available.' !!}
                                    </p>
                                </div>
                                <button class="text-[#FDB913] font-semibold mt-2 text-sm" @click="open = !open">
                                    <span
                                        x-text="open ? '{{ __('pages.read_less') }}' : '{{ __('pages.read_more') }}'"></span>
                                </button>
                            </div>
                        </div>
                    @endforeach

                </div>

                <div class="flex flex-row items-center justify-center w-full lg:w-auto space-x-4 mt-4">
                    <span class="profile-swiper-button-prev-custom swiper-nav-btn">&lt;</span>
                    <span class="profile-swiper-button-next-custom swiper-nav-btn">&gt;</span>
                </div>
            </div>

        </div>
    </div>

    <!-- SECTION 4: TESTIMONIALS (from p2.html) -->
    <div id="testomonial-profile" class="h-auto w-full justify-items-center font-poppins py-16">
        <div class="flex flex-col  w-full">
            <div id="almni-title" class="h-16 flex items-center justify-center text-white font-semibold">
                <div class="flex items-center justify-center space-x-3 my-6">
                    <span class="w-12 h-[2px] bg-[#044335]"></span>
                    <span class="text-[#000000] font-medium text-xl">{{ __('pages.alumni_testimonials') }}</span>
                    <span class="w-12 h-[2px] bg-[#044335]"></span>
                </div>
            </div>

            <div
                class="flex flex-col justify-center items-start lg:flex-row flex-wrap w-full h-auto px-4 sm:px-8 md:px-16 lg:px-28 py-6 gap-6">
                {{-- TERNARY SECTION --}}
                @php
                    $ternarySection = $sections['ternary_section'] ?? collect();
                @endphp

                @if ($ternarySection->count() > 0)
                    <div class="testimonial-swiper overflow-hidden w-full">
                        <div class="swiper-wrapper py-6">

                            @foreach ($ternarySection as $alumni)
                                <div
                                    class="flex swiper-slide items-center flex-col space-y-6 justify-between w-full sm:w-4/5 md:w-[48%] p-4 shadow-lg rounded-xl bg-white mx-auto">

                                    <div class="flex flex-col space-y-5 h-full justify-between px-2 sm:px-4">

                                        {{-- Quote Icon --}}
                                        <span class="w-8 h-6 flex-shrink-0">
                                            <img src="{{ asset('assets/frontend/images/about-us/quotemark.png') }}"
                                                class="object-contain w-full h-full" alt="mark" />
                                        </span>

                                        {{-- Testimonial Text --}}
                                        <div x-data="{ open: false }" class="mt-4 w-full">
                                            <div class="overflow-hidden transition-all duration-500"
                                                :class="open ? 'max-h-[60rem]' : 'max-h-[7.5rem]'">
                                                <p class="text-gray text-sm md:text-base leading-relaxed">
                                                    {!! optional($alumni->testimonial)->testimonial_text ?? 'No testimonial available.' !!}
                                                </p>
                                            </div>

                                            <button class="text-primary font-semibold mt-2 text-sm" @click="open = !open">
                                                <span
                                                    x-text="open ? '{{ __('pages.read_less') }}' : '{{ __('pages.read_more') }}'"></span>
                                            </button>
                                        </div>

                                        {{-- Name + Batch --}}
                                        <div class="flex flex-col space-y-1">
                                            <p class="font-semibold leading-[100%] text-base sm:text-base text-[#044335]">
                                                {{ $alumni->full_name }}
                                            </p>

                                            <span class="text-[#000000] leading-[100%] font-medium text-base sm:text-base">
                                                {{ __('pages.batch') }} {{ $alumni->batch }}
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            @endforeach

                        </div>

                        {{-- Navigation --}}
                        <div class="flex flex-row items-center justify-center w-full lg:w-auto space-x-4 mt-4">
                            <span class="testimonial-swiper-button-prev-custom swiper-nav-btn">&lt;</span>
                            <span class="testimonial-swiper-button-next-custom swiper-nav-btn">&gt;</span>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

    <!-- ===================== REGISTRATION FORM ===================== -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">

            <div class="text-center mb-10">
                <div class="flex justify-center items-center gap-3 mb-4">
                    <span class="w-12 h-[2px] bg-[#044335]"></span>
                    <h2 class="text-xl font-semibold">{{ __('pages.alumni_community_registration') }}</h2>
                    <span class="w-12 h-[2px] bg-[#044335]"></span>
                </div>
                <p class="text-gray-700 max-w-2xl mx-auto">
                    {{ __('pages.alumni_community_registration_description') }}
                </p>
            </div>

            <div class="max-w-4xl mx-auto p-6 bg-white rounded-lg shadow-md mt-10">
                @if (session('success'))
                    <div class="p-4 mb-4 text-green-800 bg-green-200 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="p-4 mb-4 text-red-800 bg-red-200 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @php
                    $prefix = app()->getLocale() === 'np' ? 'तपाईंको ' : 'Your ';
                @endphp

                <form action="{{ route('alumni.store') }}" method="POST" enctype="multipart/form-data"
                    class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                        {{-- Full Name --}}
                        <div>
                            <label class="text-sm font-semibold">{{ __('pages.full_name') }} *</label>
                            <input type="text" name="full_name" value="{{ old('full_name') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('full_name') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.full_name') }}" required>
                            @error('full_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.email') }} *</label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('email') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.email') }}" required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Mobile Number --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.phone_no') }} *</label>
                            <input type="tel" name="mobile_number" value="{{ old('mobile_number') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('mobile_number') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.phone_no') }}" required>
                            @error('mobile_number')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Occupation --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.occupation') }} *</label>
                            <input type="text" name="occupation" value="{{ old('occupation') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('occupation') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.occupation') }}" required>
                            @error('occupation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Designation --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.designation') }} *</label>
                            <input type="text" name="designation" value="{{ old('designation') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('designation') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.designation') }}" required>
                            @error('designation')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Batch --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.batch_of') }} *</label>
                            <input type="number" name="batch" value="{{ old('batch') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('batch') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.batch_of') }}" required>
                            @error('batch')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Country --}}
                        <div>
                            <label class="text-sm font-semibold"> {{ __('pages.country') }} *</label>
                            <select name="country"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('country') border-red-500 @enderror"
                                required>
                                <option value="">{{ __('pages.select_country') }}</option>
                                @foreach ($countries as $code => $country)
                                    <option value="{{ $code }}" {{ old('country') == $code ? 'selected' : '' }}>
                                        {{ $country['emoji'] }} {{ $country['name'] }}
                                    </option>
                                @endforeach
                            </select>
                            @error('country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        {{-- Testimonial Video --}}
                        <div>
                            <label class="text-sm font-semibold">{{ __('pages.testimonial_video') }}</label>
                            <input type="url" name="testimonial_video" value="{{ old('testimonial_video') }}"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('testimonial_video') border-red-500 @enderror"
                                placeholder="https://youtube.com/...">
                            @error('testimonial_video')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Company Logo --}}
                        <div>
                            <label class="text-sm font-semibold">{{ __('pages.company_logo') }}</label>
                            <input type="file" name="company_logo"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('company_logo') border-red-500 @enderror">
                            @error('company_logo')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Image --}}
                        <div>
                            <label class="text-sm font-semibold">{{ __('pages.image') }}</label>
                            <input type="file" name="image"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('image') border-red-500 @enderror">
                            @error('image')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Testimonial Text --}}
                        <div class="sm:col-span-2">
                            <label class="text-sm font-semibold"> {{ __('pages.testimonial') }} *</label>
                            <textarea name="testimonial_text" rows="4"
                                class="mt-2 w-full px-4 py-3 border rounded-lg @error('testimonial_text') border-red-500 @enderror"
                                placeholder="{{ $prefix . __('pages.testimonial') }}" required>{{ old('testimonial_text') }}</textarea>
                            @error('testimonial_text')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        {!! NoCaptcha::renderJs() !!}
                        {!! NoCaptcha::display() !!}
                        @error('g-recaptcha-response')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center">
                        <button type="submit"
                            class="px-10 py-3 bg-[#044335] text-white rounded-md font-medium hover:bg-[#03362a] transition">
                            {{ __('pages.submit') }}
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </section>

    <section class="py-16">
        <div class="text-center mb-10">
            <div class="flex justify-center items-center gap-3 mb-4">
                <span class="w-12 h-[2px] bg-[#044335]"></span>
                <h2 class="text-xl font-semibold"> {{ __('pages.alumni_header') }}"</h2>
                <span class="w-12 h-[2px] bg-[#044335]"></span>
            </div>
            <p class="text-gray-700 max-w-2xl mx-auto">
                {{ app()->getLocale() == 'en' ? $alumnidescription->group_en : $alumnidescription->group_np ?? $alumnidescription->group_en }}

            </p>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-16 flex flex-wrap gap-6 justify-center">

            @foreach ($links ?? [] as $link)
                <a href="{{ $link['link'] }}" target="_blank">
                    <div
                        class="flex-1 min-w-[450px] max-w-[480px] h-44 relative rounded-lg overflow-hidden border border-gray-200 flex flex-col justify-between p-4 transform transition-all duration-300 hover:scale-105 hover:shadow-lg">

                        <img src="{{ asset('assets/frontend/images/footer/main logo.png') }}" alt="Background"
                            class="absolute inset-0 w-full h-full object-contain z-0 p-4">

                        <div class="absolute inset-0 bg-primary bg-opacity-80 z-10"></div>

                        <div class="relative z-20 flex flex-col justify-between h-full">

                            <div class="relative">
                                <img src="{{ asset('assets/frontend/images/about-us/group.png') }}" class="w-16"
                                    alt="Logo">
                            </div>

                            <div class="flex justify-between items-center text-white">
                                <span class="text-base font-semibold">{{ $link['name'] }}</span>
                                <img src="{{ asset('assets/frontend/images/about-us/community.png') }}" class="h-16"
                                    alt="Chip">
                            </div>

                        </div>
                    </div>
                </a>
            @endforeach

        </div>

    </section>

    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script>
        function initSwiper(selector, options = {}) {
            const defaultOptions = {
                slidesPerView: 1,
                spaceBetween: 20,
                loop: true,
                speed: 500,
                centeredSlides: false,
                pagination: false,
                navigation: false,
                breakpoints: {
                    768: {
                        slidesPerView: 2,
                        spaceBetween: 20
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 20
                    },
                }
            };
            return new Swiper(selector, {
                ...defaultOptions,
                ...options
            });
        }


        initSwiper(".alumni-swiper", {
            slidesPerView: 1,
            spaceBetween: 30,
            loop: true,
            speed: 800,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".alumni-swiper-button-next-custom",
                prevEl: ".alumni-swiper-button-prev-custom"
            },
            breakpoints: {
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30
                },
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 30
                }
            }
        });


        initSwiper(".profile-swiper", {
            loop: true,
            navigation: {
                nextEl: ".profile-swiper-button-next-custom",
                prevEl: ".profile-swiper-button-prev-custom"
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                1024: {
                    slidesPerView: 4
                }
            }
        });


        initSwiper(".testimonial-swiper", {
            loop: false,
            pagination: {
                el: ".swiper-pagination",
                clickable: true
            },
            navigation: {
                nextEl: ".testimonial-swiper-button-next-custom",
                prevEl: ".testimonial-swiper-button-prev-custom"
            },
            breakpoints: {
                768: {
                    slidesPerView: 1
                },
                1024: {
                    slidesPerView: 2
                }
            }
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js"></script>
    <script>
        gsap.registerPlugin(ScrollTrigger);


        gsap.from(".w-full.sm\\:w-2\\/5 .relative", {
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power3.out",
        });

        gsap.from(".w-full.sm\\:w-3\\/5.clip-lg", {
            opacity: 0,
            x: 100,
            duration: 1,
            ease: "power3.out",
        });


        gsap.utils.toArray("section h1, #alumni-profile .text-center span, #almni-title span").forEach((title) => {
            gsap.from(title, {
                scrollTrigger: {
                    trigger: title,
                    start: "top 80%",
                },
                opacity: 0,
                y: 30,
                duration: 0.8,
                stagger: 0.2,
            });
        });


        gsap.utils.toArray(".alumni-swiper .swiper-slide").forEach((slide, i) => {
            gsap.from(slide, {
                scrollTrigger: {
                    trigger: slide,
                    start: "top 90%",
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: i * 0.2
            });
        });


        gsap.utils.toArray(".profile-swiper .swiper-slide").forEach((slide, i) => {
            gsap.from(slide, {
                scrollTrigger: {
                    trigger: slide,
                    start: "top 90%",
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: i * 0.1
            });
        });


        gsap.utils.toArray(".testimonial-swiper .swiper-slide").forEach((slide, i) => {
            gsap.from(slide, {
                scrollTrigger: {
                    trigger: slide,
                    start: "top 90%",
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: i * 0.1
            });
        });


        gsap.from(".py-16.bg-white .max-w-4xl", {
            scrollTrigger: {
                trigger: ".py-16.bg-white .max-w-4xl",
                start: "top 80%",
            },
            opacity: 0,
            y: 50,
            duration: 1,
            ease: "power3.out",
        });


        gsap.utils.toArray(".max-w-7xl.mx-auto a div").forEach((card, i) => {
            gsap.from(card, {
                scrollTrigger: {
                    trigger: card,
                    start: "top 90%",
                },
                opacity: 0,
                y: 50,
                duration: 0.8,
                delay: i * 0.2,
                ease: "power3.out",
            });
        });
    </script>
    <script>
        const modal = document.getElementById('videoGalleryModal');
        const iframe = document.getElementById('videoGalleryFrame');
        const closeBtn = document.getElementById('closeVideoGalleryModal');

        function openVideoModal(videoUrl) {
            if (!videoUrl) {
                alert('No testimonial available.');
                return;
            }


            if (videoUrl.includes("youtube.com/embed") && !videoUrl.includes("autoplay=1")) {
                videoUrl += videoUrl.includes("?") ? "&autoplay=1" : "?autoplay=1";
            }

            iframe.src = videoUrl;
            modal.classList.remove('hidden');
        }

        function closeModal() {
            iframe.src = "";
            modal.classList.add('hidden');
        }


        closeBtn.addEventListener('click', closeModal);


        modal.addEventListener('click', (e) => {

            if (e.target === modal) {
                closeModal();
            }
        });
    </script>




@endsection
