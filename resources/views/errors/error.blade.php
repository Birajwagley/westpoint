<div class="relative w-full flex flex-col items-center justify-center min-h-screen
        sm:justify-start sm:min-h-0 ">
    <h1 class="text-[12rem] 2xl:text-[25rem] 4xl:text-[25rem] font-extrabold text-secondary leading-none drop-shadow-xl">
        {{ $code }}</h1>

    <h2 class="text-xl sm:text-2xl font-semibold mt-4 text-primary">
        {{ $message }}
    </h2>

    <p class="text-center text-gray-500 max-w-md mt-3 text-sm sm:text-base px-3">
        {{ $description }}
    </p>

    <a href="{{ route('home') }}"
        class="mt-6 px-6 py-2 bg-secondary font-semibold text-white rounded-lg hover:bg-primary transition">
        Go Home
    </a>
</div>
