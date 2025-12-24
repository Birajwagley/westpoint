<div class="bg-primary items-center justify-around gap-10 text-white rounded-lg mx-6 my-10 md:m-10 lg:mx-20 p-10 ">
    <div class="flex flex-col gap-6 text-center">
        <h1 class="text-2xl lg:text-4xl font-extrabold tracking-wide">{{ __('pages.ready_to_start_journey') }}</h1>
        <p class="line-clamp-2 text-lg lg:text-xl">{{ __('pages.comprehensive_academic_programs') }}</p>
    </div>

    <div class="flex flex-col md:flex-row mt-4 items-center justify-center gap-5">
        <a href="{{ route('contact') }}"
            class="px-4 py-4 bg-white text-primary rounded-full cursor-pointer text-center text-lg inline-block font-bold hover:opacity-85">{{ __('pages.contact_us') }}</a>
        <a href="{{ $data->id == '5' ? route('online-admission.college-level') : route('online-admission.school-level') }}"
            class="px-4 py-4 bg-white text-primary rounded-full cursor-pointer text-center text-lg inline-block font-bold hover:opacity-85">{{ __('pages.apply_now') }}</a>
    </div>
</div>
