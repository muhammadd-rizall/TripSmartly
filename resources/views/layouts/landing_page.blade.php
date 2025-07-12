    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>Tranquil Resort</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            .overlay-gradient {
                background: linear-gradient(135deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%);
            }
        </style>
    </head>

    <body class="bg-gray-50">
        <!-- Header -->
        @include('layouts.header')

        <!-- Hero Section with Slider -->
        <section class="relative h-screen overflow-hidden" x-data="heroSlider()">
            <!-- Background Images -->
            <div class="absolute inset-0">
                <template x-for="(slide, index) in slides" :key="index">
                    <div class="absolute inset-0 transition-opacity duration-2000"
                        :class="{ 'opacity-100': currentSlide === index, 'opacity-0': currentSlide !== index }">
                        <img :src="slide.image" :alt="slide.title" class="w-full h-full object-cover">
                        <div class="absolute inset-0 overlay-gradient"></div>
                    </div>
                </template>
            </div>

            <!-- Hero Content -->
            <div class="relative z-10 flex flex-col justify-center items-center h-full px-4 text-center">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white mb-6 tracking-wide">
                        <span x-text="slides[currentSlide].title"></span>
                    </h1>
                    <p class="text-lg md:text-xl lg:text-2xl text-white/90 mb-8 max-w-2xl mx-auto leading-relaxed">
                        <span x-text="slides[currentSlide].description"></span>
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#"
                            class="inline-block px-8 py-4 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                            BOOK A ROOM
                        </a>
                        <a href="#"
                            class="inline-block px-8 py-4 border-2 border-white text-white font-semibold rounded-lg hover:bg-white hover:text-black transition duration-300">
                            EXPLORE MORE
                        </a>
                    </div>
                </div>
            </div>

            <!-- Slider Navigation -->
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-2 z-20">
                <template x-for="(slide, index) in slides" :key="index">
                    <button @click="goToSlide(index)" class="w-2 h-2 rounded-full transition-all duration-300"
                        :class="{ 'bg-white': currentSlide === index, 'bg-white/50': currentSlide !== index }">
                    </button>
                </template>
            </div>
        </section>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto p-6  flex-1 bg-white overflow-y-auto">
            @yield('content')
        </main>

        <!-- Footer -->
        @include('layouts.footer')

        <script>
            function heroSlider() {
                return {
                    currentSlide: 0,
                    slides: [{
                            title: 'TRANQUIL',
                            image: 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=2149&q=80',
                            description: 'Located among stunning beaches, lush coconut groves, with breathtaking views of Blue Lagoon and idyllic landscapes of Bali.'
                        },
                        {
                            title: 'PARADISE',
                            image: 'https://images.unsplash.com/photo-1561501900-3701fa6a0864?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                            description: 'Discover your perfect escape in tropical paradise where luxury meets nature in perfect harmony.'
                        },
                        {
                            title: 'SERENITY',
                            image: 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80',
                            description: 'Find your inner peace in our serene sanctuary where every moment is crafted for absolute tranquility.'
                        }
                    ],
                    autoSlide: null,

                    init() {
                        this.startAutoSlide();
                    },

                    startAutoSlide() {
                        this.autoSlide = setInterval(() => {
                            this.nextSlide();
                        }, 8000);
                    },

                    stopAutoSlide() {
                        if (this.autoSlide) {
                            clearInterval(this.autoSlide);
                        }
                    },

                    nextSlide() {
                        this.currentSlide = (this.currentSlide + 1) % this.slides.length;
                    },

                    goToSlide(index) {
                        this.currentSlide = index;
                        this.stopAutoSlide();
                        this.startAutoSlide();
                    }
                }
            }
        </script>
    </body>

    </html>
