<x-guest-layout>
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('assets/media/favicons/favicon.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/media/favicons/apple-touch-icon-180x180.png') }}">

    <div class="min-h-screen flex flex-col md:flex-row">
        <!-- Left Side Image Section -->
        <div class="hidden md:flex md:w-1/2 bg-cover bg-center relative"
            style="background-image: url('{{ asset('assets/backend/images/admin-background.jpg') }}');">
            <div class="absolute inset-0 bg-black/40"></div>
            <div class="absolute bottom-6 left-6 z-10 text-white text-sm md:text-lg font-medium">
                &copy; {{ date('Y') }} Gyanodaya Bal Batika School
            </div>
        </div>

        <!-- Login Form Section -->
        <div class="w-full md:w-1/2 flex items-center justify-center bg-gray-50 px-4 py-12 sm:px-6 lg:px-8">
            <div class="max-w-md w-full space-y-6">
                <!-- Logo -->
                <div class="text-center">
                    <img class="mx-auto h-24 md:h-32" src="{{ asset('assets/backend/images/logo.png') }}"
                        alt="Gyanodaya Bal Batika School">
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Heading -->
                <div>
                    <h2 class="text-center text-2xl font-extrabold text-gray-900">Welcome Back</h2>
                    <p class="mt-1 text-center text-sm text-gray-500">
                        Please sign in to your admin account
                    </p>
                </div>

                <!-- Form -->
                <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" name="email" type="email" autocomplete="username" required
                            autofocus class="mt-1 block w-full" :value="old('email')" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" name="password" type="password" autocomplete="current-password"
                            required class="mt-1 block w-full" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" type="checkbox"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                name="remember">
                            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a class="text-sm text-indigo-600 hover:text-indigo-500"
                                href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <x-primary-button class="w-full justify-center">
                            {{ __('Log in') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
