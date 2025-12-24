{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>

{{-- Alpine.js --}}
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

{{-- Select2 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- SweetAlert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- DataTables --}}
<script src="https://cdn.datatables.net/1.13.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.4.0/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/4.3.0/js/dataTables.fixedColumns.min.js"></script>

{{-- Summernote --}}
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>

{{-- Nepali Date Picker --}}
<script src="https://unpkg.com/nepali-date-picker@2.0.2/dist/nepaliDatePicker.min.js" crossorigin="anonymous"></script>

{{-- GSAP (only once) --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js"></script>
<script src="{{ asset('gsap-public/gsap-public/minified/ScrollTrigger.min.js') }}"></script>

{{-- Swiper --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/8.4.5/swiper-bundle.min.js"></script>

{{-- Treegrid --}}
<script src="{{ asset('assets/backend/plugins/treegrid/jquery.treegrid.min.js') }}"></script>

{{-- Icon Picker --}}
<script src="{{ asset('assets/backend/plugins/fontawesome/iconpicker-1.5.0.js') }}"></script>

{{-- Flowbite (only once) --}}
<script src="https://unpkg.com/flowbite@latest/dist/flowbite.js"></script>

<script>
    /* --------------------------------------------------------
    PRELOADER
-------------------------------------------------------- */
    let preloaderStartTime;

    function showPreloader() {
        preloaderStartTime = Date.now();
        document.getElementById("preloader").style.display = "flex";
    }

    function hidePreloader() {
        const elapsed = Date.now() - preloaderStartTime;
        const delay = Math.max(0, 500 - elapsed);

        setTimeout(() => {
            document.getElementById("preloader").style.display = "none";
            document.getElementById("content").classList.remove("hidden");
        }, delay);
    }

    window.addEventListener("load", () => {
        showPreloader();
        setTimeout(hidePreloader, 100);
    });

    /* --------------------------------------------------------
        GO TO TOP BUTTON
    -------------------------------------------------------- */
    let goToTopBtn = document.getElementById("goToTopBtn");

    if (goToTopBtn) {
        window.addEventListener("scroll", () => {
            if (window.scrollY > 100) goToTopBtn.classList.remove("hidden");
            else goToTopBtn.classList.add("hidden");
        });

        goToTopBtn.addEventListener("click", () => {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

    /* --------------------------------------------------------
        ALPINE SIDEBAR STATE
    -------------------------------------------------------- */
    function sidebarState() {
        return {
            sidebarOpen: window.innerWidth >= 1024,
            sidebarCollapsed: false,
            sidebarHovered: false,
            init() {
                window.addEventListener("resize", () => {
                    this.sidebarOpen = window.innerWidth >= 1024;
                });
            }
        };
    }

    /* --------------------------------------------------------
        SELECT2 + SUMMERNOTE INITIALIZATION
    -------------------------------------------------------- */
    $(document).ready(function() {
        $('.select, .select-multi').select2({
            theme: 'tailwindcss-3'
        });

        $('.summernote').summernote({
            height: 300,
            tabsize: 2,
            codemirror: {
                theme: 'monokai',
                mode: 'text/html',
                lineNumbers: true,
                lineWrapping: true
            },
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                    'subscript'
                ]],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'hr']],
                ['view', ['codeview', 'help']]
            ],
            fontNames: ['Poppins'],
            fontNamesIgnoreCheck: ['Poppins'],
            addDefaultFonts: false,
            callbacks: {
                onChange: function(contents) {
                    let content = $(this).summernote("code");

                    content = content.replace(/(<p><br><\/p>\s*){2,}/g, "");
                    if (content.replace(/\s+/g, '') === "<p><br></p>" || content.replace(/\s+/g,
                            '') === "<br>") {
                        $(this).summernote('code', null);
                    }
                }
            }
        });
    });

    /* --------------------------------------------------------
        ENGLISH → NEPALI NUMBER CONVERSION
    -------------------------------------------------------- */
    function convertEnglishToNepaliNumbers(number) {
        const englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        const nepaliDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

        return number.toString().split('').map(d => nepaliDigits[englishDigits.indexOf(d)] || d).join('');
    }

    /* --------------------------------------------------------
        TOAST FUNCTIONS
    -------------------------------------------------------- */
    function successToast(message) {
        Swal.fire({
            icon: "success",
            title: message,
            toast: true,
            position: "top-end",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    }

    function errorToast(message) {
        Swal.fire({
            icon: "error",
            title: message,
            toast: true,
            position: "top-end",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    }

    function warningToast(message) {
        Swal.fire({
            icon: "warning",
            title: message,
            toast: true,
            position: "top-end",
            timer: 3000,
            showConfirmButton: false,
            timerProgressBar: true
        });
    }

    /* --------------------------------------------------------
        SESSION TOAST HANDLERS
    -------------------------------------------------------- */
    @if (Session::has('success'))
        successToast('{{ Session::get('success') }}');
        @php Session::forget('success'); @endphp
    @endif

    @if (Session::has('error'))
        errorToast('{{ Session::get('error') }}');
        @php Session::forget('error'); @endphp
    @endif

    @if (Session::has('warning'))
        warningToast('{{ Session::get('warning') }}');
        @php Session::forget('warning'); @endphp
    @endif

    /* --------------------------------------------------------
        NAVBAR BEHAVIOR (VIDEO DETECTION)
    -------------------------------------------------------- */
    document.addEventListener("DOMContentLoaded", () => {

        const navbar = document.getElementById("navbar");
        const parents = document.getElementsByClassName("parent-menu");
        const videoSection = document.getElementById("video-hero");
        const hasVideo = !!videoSection;

        if (hasVideo) {
            function updateNavbarBackground() {
                const videoHeight = videoSection.offsetHeight;
                const scrollY = window.scrollY;

                let progress = scrollY / (videoHeight * 0.5);
                progress = Math.min(Math.max(progress, 0), 1);

                navbar.style.backgroundColor = `rgba(255,255,255,${progress})`;

                Array.from(parents).forEach(el => {
                    if (progress > 0.5) {
                        el.classList.remove("text-white");
                        el.classList.add("text-gray-800");
                    } else {
                        el.classList.add("text-white");
                        el.classList.remove("text-gray-800");
                    }
                });
            }

            window.addEventListener("scroll", updateNavbarBackground);
            window.addEventListener("resize", updateNavbarBackground);
            updateNavbarBackground();

        } else {
            navbar.style.backgroundColor = "white";
            Array.from(parents).forEach(el => {
                el.classList.remove("text-white");
                el.classList.add("text-gray-800");
            });
        }
    });

    /* --------------------------------------------------------
        HERO VIDEO PLAY FIX
    -------------------------------------------------------- */
    document.addEventListener("DOMContentLoaded", () => {
        const video = document.getElementById("heroVideo");

        if (video) {
            video.load();

            function playVideo() {
                video.play().catch(() => {});
            }

            video.addEventListener("loadeddata", () => {
                playVideo();
                video.classList.remove("opacity-0");
                video.classList.add("opacity-100");
            });

            setTimeout(playVideo, 400);
        }
    });
</script>

@yield('scripts')
@stack('scripts')
