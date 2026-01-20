<div
    class="grid px-6 sm:px-6 md:px-10 xl:mx-20  justify-items-center grid-cols-1 lg:grid-cols-3 2xl:grid-cols-4 justify-center mb-4 overflow-visible gap-10">
    @foreach ($datas as $key => $data)
        <div
            class="w-full sm:w-[300px] cursor-pointer md:w-80 h-[360px] flex-[1 1 300px] rounded-[20px] bg-[#205246] border border-transparent border-opacity-75 hover:border-accent transition-all duration-300 hover:scale-110 hover:shadow-2xl">
            <a a href="{{ route($route, $data->slug) }}" target="_blank">
                <div class='opacity-[100%] px-3 py-4 flex flex-col space-y-6 items-left'>
                    <h3 class='font-semibold text-base text-accent'>
                        <i class="{{ isset($data->icon) ? $data->icon : '' }}"></i>
                        {{ app()->getLocale() == 'en' ? $data->name_en : (isset($data->name_np) ? $data->name_np : $data->name_en) }}
                    </h3>

                    <p class='font-poppins font-normal text-[#FFFFFF] text-base leading-6 tracking-normal line-clamp-2'>
                        {{ app()->getLocale() == 'en' ? $data->short_description_en : (isset($data->short_description_np) ? $data->short_description_np : $data->short_description_en) }}
                    </p>

                    <div class="w-full lg: lg:w-72 h-52 relative">
                        <img class="w-full h-full object-cover rounded-xl" src="{{ asset($data->thumbnail_image) }}"
                            alt="WPHS" />

                        <div
                            class="absolute bottom-0 right-[-2px] w-0 h-0 border-l-[70px] border-l-[#205246] border-t-[70px] border-t-transparent [transform:rotateY(541deg)] rounded-bl-xl">
                        </div>

                        <a href="{{ route($route, $data->slug) }}"
                            class="absolute bottom-2 right-0 w-8 h-8 flex items-center justify-center bg-accent rounded-full shadow-md hover:scale-110 transition hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 text-[#1F413B] transform rotate-[-45deg]" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
