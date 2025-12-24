@push('styles')
    <style>
        /* Custom styles for the scroll behavior */
        .upper-nav-hidden {
            transform: translateY(-100%);
            opacity: 0;
        }

        .upper-nav-visible {
            transform: translateY(0);
            opacity: 1;
        }

        .lower-nav-logo-visible {
            display: block;
            opacity: 1;
        }

        .lower-nav-logo-hidden {
            opacity: 0;
        }

        /* Smooth transitions */
        #upperNav,
        #lowerNavLogo,
        #mobileNavLogo {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }
    </style>
@endpush

<!-- Top Nav -->
@include('frontend.layouts.partials.menu.top')

<!-- Main Nav -->
@include('frontend.layouts.partials.menu.menu', ['menus' => $menus])

{{-- Mobile Nav --}}
@include('frontend.layouts.partials.menu.mobile')

@push('scripts')
    <script>
        $(document).on('change', '#languages', function() {
            language = $(this).val();

            route = "{{ route('locale', ':lang') }}";
            route = route.replace(':lang', language);

            $.ajax({
                type: "GET",
                url: route,
                success: function(response) {
                    if (response.status == true) {
                        successToast(response.message);

                        window.location.reload();
                    } else {
                        errorToast(response.message);
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const burger = document.getElementById("burger");
            const burgerContainer = document.getElementById("burger-container");
            const mobileMenu = document.getElementById("mobile-menu");
            const closeMenu = document.getElementById("close-menu");
            const backdrop = document.querySelector(".navbar-backdrop");

            function openMobileMenu() {
                mobileMenu.classList.remove("hidden");
                burgerContainer.classList.add("hidden");
                document.body.classList.add('overflow-hidden'); // disable scroll
            }

            function closeMobileMenu() {
                mobileMenu.classList.add("hidden");
                burgerContainer.classList.remove("hidden");
                document.body.classList.remove('overflow-hidden'); // enable scroll again
            }


            burger?.addEventListener("click", openMobileMenu);
            closeMenu?.addEventListener("click", closeMobileMenu);
            backdrop?.addEventListener("click", closeMobileMenu);
        });

        window.addEventListener('scroll', function() {
            const navbar = document.getElementById('navbar');
            const topBar = document.getElementById('upperNav');

            if (!navbar || !topBar) return;

            const topBarHeight = topBar.offsetHeight;
            if (window.scrollY > topBarHeight) {
                navbar.style.top = '0px';
            } else {
                navbar.style.top = topBarHeight + 'px';
            }
        });
    </script>
@endpush
