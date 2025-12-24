@extends('frontend.layouts.app')

@section('title', 'Contact Us')

@section('content')
    {{-- @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif --}}

    {{-- Hero Section --}}
    @include('frontend.partials.hero', [
        'mainHeading' => __('pages.contact_us'),
        'subHeading' => __('pages.contact_us_description'),
        'breadcrumb1' => [
            'name' => __('route.home'),
            'route' => route('home'),
        ],
        'breadcrumb2' => [
            'name' => __('route.contact_us'),
            'route' => route('contact'),
            'class' => 'text-gray-400',
        ],
        'breadcrumb3' => null,
        'breadcrumb4' => null,
    ])

    <div class="mx-4 sm:mx-8 md:mx-12 lg:mx-20 xl:mx-36 py-14">
        <div class="flex flex-col lg:flex-row gap-10 lg:gap-12 items-stretch">

            <section class="w-full lg:w-3/5 bg-white rounded-2xl shadow-lg p-6 sm:p-8 md:p-10 flex flex-col justify-between">
                <div>
                    <div class="text-center mb-8 sm:mb-10">
                        <h2 class="text-primary font-bold uppercase tracking-widest text-sm sm:text-base">
                            {{ __('pages.get_in_touch') }}
                        </h2>

                        <h3 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mt-2">
                            {{ __('pages.we_here_to_help') }}
                        </h3>

                        <p class="text-gray-500 mt-3 max-w-2xl mx-auto text-sm sm:text-base">
                            {{ __('pages.fill_form_below') }}
                        </p>
                    </div>

                    <form action="{{ route('store-contact') }}" method="POST" class="space-y-3 flex-1 flex flex-col">
                        @csrf

                        @if (session('success'))
                            <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition.duration.500ms
                                class="mb-6 p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg text-sm text-center">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Full Name -->
                            <x-fields.text-field label="{{ __('pages.full_name') }}" :data="old('full_name')" fieldName="full_name"
                                :required=true />

                            <!-- Contact Number -->
                            <x-fields.tel-field label="{{ __('pages.contact_no') }}" :data="old('contact_no')"
                                fieldName="contact_no" :required=true />

                            <!-- Email -->
                            <x-fields.email-field label="{{ __('pages.email') }}" :data="old('email')" fieldName="email"
                                :required=true />

                            {{-- Message --}}
                            <div class="md:col-span-2">
                                <label for="message"
                                    class="block text-gray-700 font-semibold mb-2 text-sm sm:text-base">{{ __('pages.your_message') }}
                                    <span class="text-red-600">*</span></label>
                                <textarea id="message" name="message" rows="6"
                                    class="w-full border border-gray-300 rounded-md focus:border-primary focus:ring-1 focus:ring-primary p-3 resize-none text-sm sm:text-base @error('message') border-red-500 @enderror"
                                    placeholder="{{ __('pages.write_here') }}" required>{{ old('message') }}</textarea>

                                @error('message')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
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

                        <div class="text-center mt-8">
                            <button type="submit"
                                class="bg-primary text-white font-semibold text-sm sm:text-base px-8 py-3 rounded-full hover:opacity-90 transition">
                                {{ __('pages.send_message') }}
                            </button>
                        </div>
                    </form>
                </div>
            </section>

            <section
                class="w-full lg:w-2/5 relative overflow-hidden text-white rounded-2xl shadow-lg flex flex-col justify-center">
                <img src="{{ asset('assets/frontend/images/homepage/homepg.jpg') }}" alt="GBBS"
                    class="absolute inset-0 w-full h-full object-cover opacity-90 rounded-2xl">
                <div class="absolute inset-0 bg-primary opacity-80 rounded-2xl"></div>

                <div class="relative p-6 sm:p-8 md:p-10 flex flex-col justify-center h-full space-y-8">
                    <div class="text-center">
                        <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold">{{ __('pages.contact_us') }}</h2>
                        <p class="text-white text-sm sm:text-base md:text-lg mt-3">
                            {{ __('pages.feel_free') }}
                        </p>
                    </div>

                    <div class="bg-white text-gray-800 p-6 sm:p-8 rounded-2xl shadow-md space-y-8 text-sm sm:text-base">
                        {{-- Email --}}
                        <div class="flex items-start gap-4 sm:gap-5">
                            <div class="w-10 sm:w-12 md:w-14 flex-shrink-0">
                                <img src="{{ asset('assets/frontend/images/icon/email.png') }}" alt="GBBS"
                                    class="w-full h-auto">
                            </div>
                            <div>
                                <h4 class="uppercase text-base sm:text-lg font-bold text-primary">
                                    {{ __('pages.email_address') }}
                                </h4>

                                <a href="mailto:{{ json_decode($setting->email1)->email ?? 'void:;' }}"
                                    class="text-primary font-semibold hover:underline block">{{ json_decode($setting->email1)->email ?? '' }}</a>
                                <a href="mailto:{{ json_decode($setting->email2)->email ?? 'void:;' }}"
                                    class="text-primary font-semibold hover:underline block">{{ json_decode($setting->email2)->email ?? '' }}</a>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start gap-4 sm:gap-5">
                            <div class="w-10 sm:w-12 md:w-14 flex-shrink-0">
                                <img src="{{ asset('assets/frontend/images/icon/phone.png') }}" alt="GBBS"
                                    class="w-full h-auto">
                            </div>
                            <div>
                                <h4 class="uppercase text-base sm:text-lg font-bold text-primary">
                                    {{ __('pages.phone_no') }}</h4>
                                <a href="tel:{{ json_decode($setting->contact)->contact ?? 'void:;' }}"
                                    class="text-primary font-semibold hover:underline block">{{ json_decode($setting->contact)->contact ?? '' }}</a>
                            </div>
                        </div>

                        {{-- Social --}}
                        <div class="flex items-start gap-4 sm:gap-5">
                            <div class="w-10 sm:w-12 md:w-14 flex-shrink-0">
                                <img src="{{ asset('assets/frontend/images/icon/community.png') }}" alt="GBBS"
                                    class="w-full h-auto">
                            </div>
                            <div>
                                <h4 class="uppercase text-base sm:text-lg font-bold text-primary">
                                    {{ __('pages.social_community') }}
                                </h4>

                                <p class="text-gray-700">{{ __('pages.stay_connected_with_us') }}:</p>

                                <div class="flex flex-wrap items-center gap-3 mt-3">
                                    @if (isset($setting->facebook))
                                        <a href="{{ $setting->facebook }}" target="_blank"
                                            class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                            <i
                                                class="fa-brands fa-facebook-f fa-xl text-primary group-hover:text-gray-100"></i>
                                        </a>
                                    @endif

                                    @if (isset($setting->instagram))
                                        <a href="{{ $setting->instagram }}" target="_blank"
                                            class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                            <i
                                                class="fa-brands fa-instagram fa-xl text-primary group-hover:text-gray-100"></i>
                                        </a>
                                    @endif

                                    @if (isset($setting->linkedin))
                                        <a href="{{ $setting->linkedin }}" target="_blank"
                                            class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                            <i
                                                class="fa-brands fa-linkedin-in fa-xl text-primary group-hover:text-gray-100"></i>
                                        </a>
                                    @endif

                                    @if (isset($setting->x))
                                        <a href="{{ $setting->x }}" target="_blank"
                                            class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                            <i
                                                class="fa-brands fa-x-twitter fa-xl text-primary group-hover:text-gray-100"></i>
                                        </a>
                                    @endif

                                    @if (isset($setting->youtube))
                                        <a href="{{ $setting->youtube }}" target="_blank"
                                            class="group w-8 h-8 sm:w-9 sm:h-9 flex items-center justify-center rounded-full bg-gray-100 hover:bg-primary transition">
                                            <i
                                                class="fa-brands fa-youtube fa-xl text-primary group-hover:text-gray-100"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>

    {{-- ✅ Google Map --}}
    <section>
        <iframe src="{{ $setting->map ?? '' }}"
            class="w-full h-[350px] sm:h-[400px] md:h-[450px] rounded-xl border-0 shadow-md" allowfullscreen
            loading="lazy"></iframe>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: "{{ __('pages.message_sent') }}",
                    text: "{{ __('pages.thankyou_for_contacting') }}",
                    confirmButtonColor: '#10B981'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: "{{ __('pages.please_try_again') }}",
                    text: "{{ __('pages.something_went_wrong') }}",
                    confirmButtonColor: '#EF4444'
                });
            @endif
        });
    </script>
@endpush
