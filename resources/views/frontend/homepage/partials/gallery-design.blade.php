<!-- Feather Icons -->
<script src="https://unpkg.com/feather-icons"></script>

<style>
    .tab-active {
        background-color: #990400;
        color: white;
    }

    .tab-inactive {
        background-color: white;
        color: #4b5563;
    }

    .gallery-item img {
        transition: transform 0.4s ease;
    }

    .gallery-item:hover img {
        transform: scale(1.08);
    }
</style>

<div class="bg-gray-50 text-gray-800">

    <section class="max-w-7xl mx-auto px-4 py-16">

        <!-- Heading -->
        <div class="text-center mb-10">
            <span class="inline-block px-4 py-2 rounded-full bg-primary text-white text-sm font-medium mb-4">
                Media Gallery
            </span>
            <h2 class="text-4xl font-bold mb-3">
                Moments & <span class="text-primary">Milestones</span>
            </h2>
            <p class="text-gray-500 max-w-2xl mx-auto">
                Explore our branches, events, and community initiatives across Nepal.
            </p>
        </div>

        <!-- Tabs -->
        <div class="flex flex-wrap justify-center gap-2 mb-10">

            <!-- Type Tabs -->
            <button data-type="all" class="type-btn tab-active px-4 py-2 rounded-md text-sm font-medium">
                All
            </button>
            <button data-type="image"
                class="type-btn tab-inactive px-4 py-2 rounded-md text-sm font-medium flex gap-1 items-center">
                <i data-feather="image" class="w-4 h-4"></i> Images
            </button>
            <button data-type="video"
                class="type-btn tab-inactive px-4 py-2 rounded-md text-sm font-medium flex gap-1 items-center">
                <i data-feather="play" class="w-4 h-4"></i> Videos
            </button>

            <!-- Category Tabs -->
            <button data-filter="All" class="filter-btn tab-active px-4 py-2 rounded-full text-sm font-medium">
                All
            </button>
            <button data-filter="Branches" class="filter-btn tab-inactive px-4 py-2 rounded-full text-sm font-medium">
                Branches
            </button>
            <button data-filter="Events" class="filter-btn tab-inactive px-4 py-2 rounded-full text-sm font-medium">
                Events
            </button>
            <button data-filter="Testimonials"
                class="filter-btn tab-inactive px-4 py-2 rounded-full text-sm font-medium">
                Testimonials
            </button>

        </div>

        <!-- Gallery -->
        <div id="gallery" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <!-- IMAGE -->
            <div class="gallery-item cursor-pointer relative rounded-xl overflow-hidden" data-type="image"
                data-category="Branches" data-title="Head Office">
                <img src="https://images.unsplash.com/photo-1541354329998-f4d9a9f9297f?w=800"
                    class="w-full h-full object-cover aspect-[4/3]">
            </div>

            <!-- VIDEO -->
            <div class="gallery-item cursor-pointer relative rounded-xl overflow-hidden" data-type="video"
                data-category="Events" data-title="Financial Literacy"
                data-video="https://www.youtube.com/embed/dQw4w9WgXcQ">
                <img src="https://images.unsplash.com/photo-1556761175-5973dc0f32e7?w=800"
                    class="w-full h-full object-cover aspect-[4/3]">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-16 h-16 rounded-full bg-white/30 backdrop-blur flex items-center justify-center">
                        <i data-feather="play" class="text-white w-8 h-8"></i>
                    </div>
                </div>
            </div>

            <!-- IMAGE -->
            <div class="gallery-item cursor-pointer relative rounded-xl overflow-hidden" data-type="image"
                data-category="Events" data-title="Annual Meeting">
                <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=800"
                    class="w-full h-full object-cover aspect-[4/3]">
            </div>

        </div>
    </section>

    <!-- LIGHTBOX -->
    <div id="lightbox" class="hidden fixed inset-0 z-50 bg-black/90 flex items-center justify-center p-4">

        <button id="close" class="absolute top-4 right-4 text-white hover:bg-white/10 p-2 rounded-full">
            <i data-feather="x"></i>
        </button>

        <div id="lightbox-content" class="max-w-4xl w-full"></div>
    </div>

    <!-- SCRIPT -->
    <script>
        feather.replace();

        /* ---------------- STATE ---------------- */
        const state = {
            type: "all",
            category: "All",
            index: 0
        };

        const items = [...document.querySelectorAll(".gallery-item")];
        const lightbox = document.getElementById("lightbox");
        const content = document.getElementById("lightbox-content");

        /* ---------------- HELPERS ---------------- */
        function setActive(group, activeBtn) {
            group.forEach(btn => {
                btn.classList.remove("tab-active");
                btn.classList.add("tab-inactive");
            });
            activeBtn.classList.add("tab-active");
            activeBtn.classList.remove("tab-inactive");
        }

        function filterGallery() {
            items.forEach(item => {
                const typeMatch = state.type === "all" || item.dataset.type === state.type;
                const catMatch = state.category === "All" || item.dataset.category === state.category;
                item.classList.toggle("hidden", !(typeMatch && catMatch));
            });
        }

        /* ---------------- TAB EVENTS ---------------- */
        document.querySelectorAll(".type-btn").forEach(btn => {
            btn.onclick = () => {
                state.type = btn.dataset.type;
                setActive(document.querySelectorAll(".type-btn"), btn);
                filterGallery();
            };
        });

        document.querySelectorAll(".filter-btn").forEach(btn => {
            btn.onclick = () => {
                state.category = btn.dataset.filter;
                setActive(document.querySelectorAll(".filter-btn"), btn);
                filterGallery();
            };
        });

        /* ---------------- LIGHTBOX ---------------- */
        items.forEach((item, i) => {
            item.onclick = () => {
                state.index = i;
                openLightbox(items[state.index]);
            };
        });

        function openLightbox(item) {
            content.innerHTML = "";
            const type = item.dataset.type;

            if (type === "image") {
                content.innerHTML = `<img src="${item.querySelector("img").src}" class="rounded-lg w-full">`;
            }

            if (type === "video") {
                content.innerHTML = `
                <div class="relative aspect-video">
                    <img src="${item.querySelector("img").src}" class="rounded-lg w-full h-full object-cover">
                    <button id="playVideo" class="absolute inset-0 flex items-center justify-center">
                        <div class="w-16 h-16 rounded-full bg-white/30 flex items-center justify-center">
                            <i data-feather="play" class="text-white w-8 h-8"></i>
                        </div>
                    </button>
                </div>`;
                feather.replace();

                document.getElementById("playVideo").onclick = () => {
                    content.innerHTML = `
                    <iframe src="${item.dataset.video}?autoplay=1"
                            class="w-full aspect-video rounded-lg"
                            allow="autoplay; encrypted-media"
                            allowfullscreen></iframe>`;
                };
            }

            lightbox.classList.remove("hidden");
        }

        /* ---------------- NAVIGATION ---------------- */
        function showNext() {
            let nextIndex = state.index;
            do {
                nextIndex = (nextIndex + 1) % items.length;
            } while (items[nextIndex].classList.contains("hidden"));
            state.index = nextIndex;
            openLightbox(items[state.index]);
        }

        function showPrev() {
            let prevIndex = state.index;
            do {
                prevIndex = (prevIndex - 1 + items.length) % items.length;
            } while (items[prevIndex].classList.contains("hidden"));
            state.index = prevIndex;
            openLightbox(items[state.index]);
        }

        /* ---------- ADD NAV BUTTONS ---------- */
        const prevBtn = document.createElement("button");
        prevBtn.innerHTML = `<i data-feather="chevron-left" class="w-8 h-8 text-white"></i>`;
        prevBtn.className = "absolute left-4 top-1/2 -translate-y-1/2 p-2 hover:bg-white/10 rounded-full";
        prevBtn.onclick = showPrev;

        const nextBtn = document.createElement("button");
        nextBtn.innerHTML = `<i data-feather="chevron-right" class="w-8 h-8 text-white"></i>`;
        nextBtn.className = "absolute right-4 top-1/2 -translate-y-1/2 p-2 hover:bg-white/10 rounded-full";
        nextBtn.onclick = showNext;

        lightbox.appendChild(prevBtn);
        lightbox.appendChild(nextBtn);
        feather.replace();

        /* ---------------- CLOSE LIGHTBOX ---------------- */
        document.getElementById("close").onclick = () => {
            lightbox.classList.add("hidden");
            content.innerHTML = "";
        };

        /* ---------------- KEYBOARD SUPPORT ---------------- */
        document.addEventListener("keydown", (e) => {
            if (e.key === "Escape") {
                lightbox.classList.add("hidden");
                content.innerHTML = "";
            }
            if (e.key === "ArrowRight") showNext();
            if (e.key === "ArrowLeft") showPrev();
        });
    </script>

</div>
