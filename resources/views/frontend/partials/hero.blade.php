<section
    class="relative w-full bg-cover bg-center h-[270px] sm:h-[350px] md:h-[270px] lg:h-[270px] xl:h-[270px] mt-[90px]"
    style="background-image: url('{{ $setting->school_overview_image
        ? asset($setting->school_overview_image)
        : asset('assets/frontend/images/header/breadcrumb.jpg') }}');"
    aria-label="GBBS">

    <!-- Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 to-black/40"></div>

    <!-- Content -->
    <div class="relative flex flex-col items-center justify-center h-full text-center text-white px-4 sm:px-8">
        <h1 class="text-3xl sm:text-3xl md:text-4xl lg:text-5xl font-heading font-bold animate-fadeIn">
            {{ $mainHeading }}
        </h1>

        <p class="mt-3 sm:mt-4 text-base sm:text-lg md:text-lg max-w-2xl animate-slideUp">
            {{ $subHeading }}
        </p>

        <!-- Breadcrumb -->
        <nav class="mt-6">
            <ol class="flex flex-wrap justify-center items-center gap-2 text-sm sm:text-base text-white">
                @if ($breadcrumb1 != null)
                    <li>
                        <a href="{{ $breadcrumb1['route'] }}"
                            class="hover:text-accent transition text-white {{ $breadcrumb1['class'] ?? '' }}">
                            {{ $breadcrumb1['name'] }}
                        </a>
                    </li>
                @endif

                @if ($breadcrumb2 != null)
                    <li>/</li>
                    <li>
                        <a href="{{ $breadcrumb2['route'] }}"
                            class="hover:text-accent transition text-white {{ $breadcrumb2['class'] ?? '' }}">
                            {{ $breadcrumb2['name'] }}
                        </a>
                    </li>
                @endif

                @if ($breadcrumb3 != null)
                    <li>/</li>
                    <li>
                        <a href="{{ $breadcrumb3['route'] }}"
                            class="hover:text-accent transition text-white {{ $breadcrumb3['class'] ?? '' }}">
                            {{ $breadcrumb3['name'] }}
                        </a>
                    </li>
                @endif

                @if ($breadcrumb4 != null)
                    <li>/</li>
                    <li>
                        <a href="{{ $breadcrumb4['route'] }}"
                            class="hover:text-accent transition text-white {{ $breadcrumb4['class'] ?? '' }}">
                            {{ $breadcrumb4['name'] }}
                        </a>
                    </li>
                @endif
            </ol>
        </nav>
    </div>
</section>
