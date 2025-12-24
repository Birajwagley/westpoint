@php
    use Carbon\Carbon;
    use Anuzpandey\LaravelNepaliDate\LaravelNepaliDate;

    $upcommingEvents = $publicationCategory->where('id', 1)->first();
    $importantNotices = $publicationCategory->where('id', 2)->first();
@endphp

<div id="upcomingEvent-section" class="bg-primary w-full font-poppins flex justify-center overflow-x-hidden">
    <div class="w-full lg:w-[70%] px-6 md:px-20 lg:px-2 py-16">

        <div class="flex flex-col lg:flex-row gap-16">

            <!-- ======================= Upcoming Events ======================= -->
            <div class="flex-1">
                <div id="upcoming-head1" class="flex justify-between items-center mb-10">
                    <h2 class="text-xl font-semibold text-white">
                        {{ app()->getLocale() == 'en' ? $upcommingEvents->name_en : $upcommingEvents->name_np ?? $upcommingEvents->name_en }}
                    </h2>

                    <a href="{{ route('publication') }}"
                        class="group flex items-center text-white font-semibold hover:text-accent">
                        {!! __('homepage.view_all') !!}
                        <i class="fa-solid fa-angle-right ml-2 text-white group-hover:text-accent"></i>
                    </a>
                </div>

                <!-- Cards Grid -->
                <div id="upcoming-head2" class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($upcommingEvents->publications as $event)
                        <a href="{{ route('publication-detail', $event->slug) }}" target="_blank"
                            class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 hover:scale-105">

                            <img src="{{ asset($event->thumbnail_image) }}" class="w-full h-40 object-cover"
                                alt="Upcoming Event">

                            <div class="p-4 space-y-2">
                                <p class="text-primary font-semibold text-sm">
                                    {{ app()->getLocale() == 'en'
                                        ? Carbon::parse($event->published_date)->format('d F Y')
                                        : LaravelNepaliDate::from($event->published_date)->toNepaliDate('j F Y', 'np') }}
                                </p>

                                <p class="text-black font-semibold text-sm line-clamp-2">
                                    {{ app()->getLocale() == 'en' ? $event->name_en : $event->name_np ?? $event->name_en }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- ======================= Important Notices ======================= -->
            <div class="flex-1">
                <div id="upcoming-head1" class="flex justify-between items-center mb-10">
                    <h2 class="text-xl font-semibold text-white">
                        {{ app()->getLocale() == 'en' ? $importantNotices->name_en : $importantNotices->name_np ?? $importantNotices->name_en }}
                    </h2>

                    <a href="{{ route('publication') }}"
                        class="group flex items-center text-white font-semibold hover:text-accent">
                        {!! __('homepage.view_all') !!}
                        <i class="fa-solid fa-angle-right ml-2 text-white group-hover:text-accent"></i>
                    </a>
                </div>

                <div id="upcoming-head3" class="flex flex-col gap-8">
                    @foreach ($importantNotices->publications as $notice)
                        <a href="{{ route('publication-detail', $notice->slug) }}" target="_blank" class="group block">
                            <div class="flex gap-6">

                                <!-- Date Box -->
                                <div
                                    class="w-28 h-28 flex items-center justify-center rounded-xl bg-secondary p-2 text-center">
                                    <span
                                        class="font-semibold text-base text-accent group-hover:text-accent transition">
                                        {{ app()->getLocale() == 'en'
                                            ? Carbon::parse($notice->published_date)->format('d F Y')
                                            : LaravelNepaliDate::from($notice->published_date)->toNepaliDate('j F Y', 'np') }}
                                    </span>
                                </div>

                                <!-- Text Content -->
                                <div class="flex-1 flex flex-col justify-center space-y-2">
                                    <p
                                        class="text-base font-semibold text-white leading-6 line-clamp-2 group-hover:text-accent transition">
                                        {{ app()->getLocale() == 'en' ? $notice->name_en : $notice->name_np ?? $notice->name_en }}
                                    </p>

                                    <p
                                        class="text-sm text-gray-200 leading-6 line-clamp-3 group-hover:text-accent transition">
                                        {{ app()->getLocale() == 'en'
                                            ? $notice->short_description_en
                                            : $notice->short_description_np ?? $notice->short_description_en }}
                                    </p>
                                </div>

                                <!-- Thumbnail -->
                                <div
                                    class="w-28 h-28 flex items-center justify-center rounded-xl bg-secondary p-2 overflow-hidden">
                                    <img src="{{ asset($notice->thumbnail_image) }}"
                                        class="w-full h-full object-cover rounded-lg" alt="Notice Thumbnail">
                                </div>

                            </div>
                        </a>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</div>


@push('scripts')
    <script>
        gsap.registerPlugin(ScrollTrigger);

        gsap.from("#upcoming-head1", {
            y: -100,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#upcomingEvent-section",
                start: "top 80%",
                toggleActions: "play none none none",
            }
        });

        gsap.from("#upcoming-head2", {
            x: -200,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#upcoming-head2",
                start: "top 85%",
                toggleActions: "play none none none",
            }
        });

        gsap.from("#upcoming-head3", {
            x: 200,
            opacity: 0,
            duration: 1,
            ease: "power3.out",
            scrollTrigger: {
                trigger: "#upcoming-head3",
                start: "top 85%",
                toggleActions: "play none none none",
            }
        });
    </script>
@endpush
