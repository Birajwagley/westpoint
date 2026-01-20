    <section class="relative overflow-hidden bg-background py-20 lg:py-20">
        <div class="container mx-auto px-4">

            <!-- Header -->
            <div class="mx-auto max-w-4xl text-center mb-16">
                <div class="flex items-center justify-center gap-4 mb-6">
                    <h2 class="uppercase tracking-[0.3em] font-semibold text-primary text-sm md:text-base">
                        Our Programs
                    </h2>
                    <div class="flex gap-1.5">
                        <span class="w-8 h-3 bg-primary"></span>
                        <span class="w-4 h-3 bg-primary"></span>
                    </div>
                </div>

                <h1 class="font-bold text-2xl sm:text-3xl lg:text-4xl text-secondary mb-6 leading-tight">
                    Academic Excellence <span class="text-primary">at Every Level</span>

                </h1>

                <p class="text-gray-600 text-base md:text-lg leading-relaxed">
                    From early childhood education to higher secondary, we offer comprehensive programs designed to
                    unlock every student's potential. </p>
            </div>

            <div id="academics">
                <div class="max-w-7xl mx-auto px-4">
                    <!-- PROGRAM TABS -->
                    <div class="flex flex-wrap justify-center gap-2 mb-12" id="programTabs">
                        <button data-id="pre-primary" class="tab-btn active">Pre-Primary</button>
                        <button data-id="primary" class="tab-btn">Primary</button>
                        <button data-id="lower-secondary" class="tab-btn">Lower Secondary</button>
                        <button data-id="secondary" class="tab-btn">Secondary (SEE)</button>
                        <button data-id="plus-two" class="tab-btn">+2 Level</button>
                    </div>

                    <!-- CONTENT -->
                    <div id="programContent" class="grid lg:grid-cols-2 gap-8 items-center">

                        <!-- IMAGE -->
                        <div class="relative rounded-2xl overflow-hidden shadow-[0_10px_40px_rgba(0,0,0,0.12)]">
                            <img id="programImage" class="w-full h-80 lg:h-96 object-cover" />
                            <div id="programSubtitle"
                                class="absolute top-4 left-4 bg-primary text-white px-4 py-2 rounded-full font-semibold text-sm">
                            </div>
                        </div>

                        <!-- CONTENT -->
                        <div class="space-y-6">
                            <div>
                                <h3 id="programTitle" class="text-2xl font-bold text-secondary mb-2"></h3>
                                <div class="flex items-center gap-4 text-sm text-[#6b7280] mb-4">
                                    <span>👥 Age: <span id="programAge"></span></span>
                                    <span>⏰ Full-time</span>
                                </div>
                                <p id="programDescription" class="text-[#6b7280]"></p>
                            </div>

                            <!-- FEATURES -->
                            <div id="programFeatures" class="grid grid-cols-2 gap-3"></div>

                            <!-- BUTTONS -->
                            <div class="flex flex-col sm:flex-row gap-3">
                                 <a href="{{ route('about-us') }}" target="_blank"
                    class="w-[150px] tracking-wide flex items-center gap-2 shadow-xl text-sm bg-primary backdrop-blur-md lg:font-semibold relative px-4 py-2 overflow-hidden rounded-full group text-white
                        before:absolute before:w-full before:transition-all before:duration-700 before:hover:w-full before:-left-full before:hover:left-0
                        before:rounded-full before:bg-secondary hover:text-white before:-z-10 before:aspect-square before:hover:scale-150 before:hover:duration-700">

                    Know More

                    <svg class="w-8 h-8 justify-end group-hover:rotate-90 bg-white text-white ease-linear duration-300 rounded-full border border-white group-hover:border-none p-2 rotate-45"
                        viewBox="0 0 16 19">
                        <path d="M7 18C7 18.5523 7.44772 19 8 19C8.55228 19 9 18.5523 9 18H7ZM8.70711 0.292893C8.31658 -0.0976311 7.68342 -0.0976311 7.29289 0.292893L0.928932 6.65685C0.538408 7.04738 0.538408 7.68054
                                            0.928932 8.07107C1.31946 8.46159 1.95262 8.46159 2.34315 8.07107L8 2.41421L13.6569 8.07107C14.0474 8.46159 14.6805 8.46159 15.0711 8.07107C15.4616 7.68054 15.4616 7.04738 15.0711
                                            6.65685L8.70711 0.292893ZM9 18L9 1H7L7 18H9Z"
                            class="fill-gray-800 text-white">
                        </path>
                    </svg>
                </a>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- ===================== JAVASCRIPT ===================== -->
                <script>
                    const programs = {
                        "pre-primary": {
                            title: "Pre-Primary",
                            subtitle: "Nursery - KG",
                            age: "3-5 years",
                            description: "A nurturing environment where young minds explore, play, and develop foundational skills through activity-based learning.",
                            features: ["Play-based Learning", "Motor Skills Development", "Social Skills", "Creative Activities"],
                            image: "https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=800&q=80",
                        },
                        "primary": {
                            title: "Primary",
                            subtitle: "Class 1-5",
                            age: "6-10 years",
                            description: "Building strong academic foundations with emphasis on reading, writing, mathematics, and holistic development.",
                            features: ["Core Academics", "Extra-Curricular", "Personality Development", "Value Education"],
                            image: "https://images.unsplash.com/photo-1509062522246-3755977927d7?auto=format&fit=crop&w=800&q=80",
                        },
                        "lower-secondary": {
                            title: "Lower Secondary",
                            subtitle: "Class 6-8",
                            age: "11-13 years",
                            description: "Preparing students for advanced learning with specialized subjects and critical thinking skills development.",
                            features: ["Subject Specialization", "Science Labs", "Computer Education", "Sports Program"],
                            image: "https://images.unsplash.com/photo-1427504494785-3a9ca7044f45?auto=format&fit=crop&w=800&q=80",
                        },
                        "secondary": {
                            title: "Secondary (SEE)",
                            subtitle: "Class 9-10",
                            age: "14-16 years",
                            description: "Comprehensive preparation for SEE board examinations with focus on academic excellence and career guidance.",
                            features: ["Board Exam Prep", "Career Counseling", "Leadership Programs", "Community Service"],
                            image: "https://images.unsplash.com/photo-1524178232363-1fb2b075b655?auto=format&fit=crop&w=800&q=80",
                        },
                        "plus-two": {
                            title: "Higher Secondary (+2)",
                            subtitle: "Science / Management / Humanities",
                            age: "16-18 years",
                            description: "Specialized streams preparing students for university education and professional careers with NEB curriculum.",
                            features: ["Science Stream", "Management Stream", "Humanities Stream", "Entrance Preparation"],
                            image: "https://images.unsplash.com/photo-1562774053-701939374585?auto=format&fit=crop&w=800&q=80",
                        },
                    };

                    const buttons = document.querySelectorAll(".tab-btn");
                    const title = document.getElementById("programTitle");
                    const subtitle = document.getElementById("programSubtitle");
                    const age = document.getElementById("programAge");
                    const description = document.getElementById("programDescription");
                    const image = document.getElementById("programImage");
                    const featuresContainer = document.getElementById("programFeatures");

                    let isInitialLoad = true;

                    function setActiveButton(id) {
                        buttons.forEach(btn => {
                            btn.className =
                                "tab-btn px-6 py-3 rounded-full text-sm font-medium transition-all duration-300 bg-white text-[#6b7280] hover:bg-primary/10";
                        });
                        document.querySelector(`[data-id="${id}"]`).className =
                            "tab-btn px-6 py-3 rounded-full text-sm font-medium transition-all duration-300 bg-primary text-white shadow-[0_4px_20px_rgba(0,0,0,0.08)]";
                    }

                    function renderProgram(program) {
                        title.textContent = program.title + " Program";
                        subtitle.textContent = program.subtitle;
                        age.textContent = program.age;
                        description.textContent = program.description;
                        image.src = program.image;

                        featuresContainer.innerHTML = "";
                        program.features.forEach(feature => {
                            const div = document.createElement("div");
                            div.className =
                                "flex items-center gap-2 bg-white p-3 rounded-lg shadow-[0_4px_20px_rgba(0,0,0,0.08)]";
                            div.innerHTML = `⭐ <span class="text-sm font-medium">${feature}</span>`;
                            featuresContainer.appendChild(div);
                        });
                    }

                    function setActiveProgram(id) {
                        const program = programs[id];
                        setActiveButton(id);

                        if (isInitialLoad) {
                            renderProgram(program);
                            gsap.set("#programContent", {
                                opacity: 1,
                                y: 0
                            });
                            isInitialLoad = false;
                            return;
                        }

                        gsap.to("#programContent", {
                            opacity: 0,
                            y: 20,
                            duration: 0.25,
                            onComplete: () => {
                                renderProgram(program);

                                gsap.to("#programContent", {
                                    opacity: 1,
                                    y: 0,
                                    duration: 0.4
                                });
                                gsap.from("#programImage", {
                                    scale: 1.05,
                                    duration: 0.6
                                });
                                gsap.from("#programFeatures > div", {
                                    opacity: 0,
                                    y: 20,
                                    stagger: 0.08,
                                    duration: 0.4,
                                });
                            },
                        });
                    }

                    buttons.forEach(btn => {
                        btn.addEventListener("click", () => {
                            setActiveProgram(btn.dataset.id);
                        });
                    });

                    document.addEventListener("DOMContentLoaded", () => {
                        setActiveProgram("plus-two");
                    });
                </script>

                <!-- ===================== TAILWIND BUTTON STYLE ===================== -->
                <style>
                    .tab-btn {
                        @apply px-6 py-3 rounded-full text-sm font-medium transition-all duration-300 bg-white text-[#6b7280] hover:bg-primary/10;
                    }
                </style>
            </div>
    </section>
