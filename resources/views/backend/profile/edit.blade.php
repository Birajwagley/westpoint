@extends('backend.layouts.app')

@section('title')
    User Profile
@endsection

@section('headerWithButton')
    <h2 class="text-xl font-semibold text-gray-900"> @yield('title'): {{ $user->username }}</h2>
@endsection


@section('content')
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

            <div>
                <label class="form-label font-semibold" for="thumbnail_image">Thumbnail Image</label>
                <input type="file" name="thumbnail_image" id="thumbnail_image" accept="image/*"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('username') border-red-500 @enderror">

                @error('thumbnail_image')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
                @if (isset($user) && $user->thumbnail_image)
                    <div class="mt-4">
                        <div
                            class="w-24 h-24 rounded-xl overflow-hidden shadow-md ring-1 ring-gray-300 hover:ring-blue-400 transition-all duration-300">
                            <img src="{{ asset($user->thumbnail_image) }}" alt="Current Thumbnail"
                                class="w-full h-full object-cover">
                        </div>
                    </div>
                @endif

            </div>


            <!-- Username -->
            <div>
                <label for="username" class="block text-sm font-semibold text-gray-700">
                    Username <span class="text-red-600">*</span>
                </label>
                <input type="text" id="username" name="username"
                    value="{{ old('username', isset($user) ? $user->username : null) }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('username') border-red-500 @enderror">
                @error('username')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name -->
            <div>
                <label for="name" class="block text-sm font-semibold text-gray-700">
                    Name <span class="text-red-600">*</span>
                </label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', isset($user) ? $user->name : null) }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('name') border-red-500 @enderror">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-semibold text-gray-700">
                    Email <span class="text-red-600">*</span>
                </label>
                <input type="email" id="email" name="email"
                    value="{{ old('email', isset($user) ? $user->email : null) }}"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('email') border-red-500 @enderror">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-semibold text-gray-700">
                    Password @if (!isset($user))
                        <span class="text-red-600">*</span>
                    @endif
                </label>
                <input type="password" id="password" name="password"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('password') border-red-500 @enderror">
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password Confirmation -->
            <div>
                <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">
                    Password Confirmation @if (!isset($user))
                        <span class="text-red-600">*</span>
                    @endif
                </label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="mt-1 block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-primary focus:border-primary @error('password_confirmation') border-red-500 @enderror">
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>


        <div class="flex mt-6 gap-2">
            <x-buttons.form-save-button type="Update" />
            <x-buttons.form-cancel-button href="{{ route('profile.edit') }}" />
        </div>


    </form>
@endsection
