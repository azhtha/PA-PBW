<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Taman Salma Shofa</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="assets/carousel.css">
    <style>
        .carousel-nav-btn {
            transition: all 0.3s ease;
        }
        .carousel-nav-btn:hover {
            transform: scale(1.1);
        }
        .carousel-nav-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
            transform: scale(1);
        }
        .swiper {
            overflow: hidden;
        }
        .swiper-slide {
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .about-image {
            object-fit: cover;
            width: 100%;
            height: 100%;
        }
    </style>
</head>
<body class="bg-white font-sans">
    
    <!-- Navbar -->
    <?php include __DIR__ . '/../includes/navbar.php'; ?>

    <!-- Main Content -->
    <main class="min-h-screen">
        
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-[#2B2B43] to-[#403f54] py-16 px-6 md:px-12">
            <div class="max-w-[1440px] mx-auto">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tentang Kami</h1>
                <p class="text-[#EAA07E] text-lg">Kenali lebih jauh tentang Taman Salma Shofa</p>
            </div>
        </section>

        <!-- About Section with Carousel -->
        <section class="py-16 px-6 md:px-12">
            <div class="max-w-[1440px] mx-auto">
                
                <!-- About Description -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#2B2B43] mb-6">Selamat Datang di Taman Salma Shofa</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div>
                            <p class="text-gray-700 leading-relaxed mb-4">
                                Taman Salma Shofa adalah destinasi wisata keluarga yang menawarkan pengalaman unik dan berkesan. 
                                Dengan fasilitas lengkap dan layanan terbaik, kami berkomitmen untuk memberikan kepuasan maksimal 
                                bagi setiap pengunjung.
                            </p>
                            <p class="text-gray-700 leading-relaxed">
                                Sejak didirikan, kami terus berinovasi untuk menghadirkan atraksi dan layanan yang sesuai dengan 
                                kebutuhan keluarga modern. Kepuasan Anda adalah prioritas utama kami.
                            </p>
                        </div>
                        <div class="bg-[#E88D57]/10 p-6 rounded-lg border-l-4 border-[#E88D57]">
                            <h3 class="text-xl font-bold text-[#2B2B43] mb-4">Nilai Kami</h3>
                            <ul class="space-y-3 text-gray-700">
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-[#E88D57] mt-1"></i>
                                    <span>Kualitas layanan terbaik</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-[#E88D57] mt-1"></i>
                                    <span>Keamanan dan kenyamanan pengunjung</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-[#E88D57] mt-1"></i>
                                    <span>Inovasi berkelanjutan</span>
                                </li>
                                <li class="flex items-start gap-3">
                                    <i class="fa-solid fa-check text-[#E88D57] mt-1"></i>
                                    <span>Kepuasan pelanggan</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Photo Carousel Section -->
                <div class="mb-16">
                    <h2 class="text-3xl md:text-4xl font-bold text-[#2B2B43] mb-8 text-center">Galeri Foto</h2>
                    
                    <!-- Carousel Container -->
                    <div class="relative bg-gray-100 rounded-lg overflow-hidden shadow-lg">
                        
                        <!-- Swiper Carousel -->
                        <div class="swiper carousel-swiper w-full h-[300px] md:h-[500px]">
                            <div class="swiper-wrapper">
                                <!-- Slide 1 -->
                                <div class="swiper-slide">
                                    <img src="assets/hero.png" alt="Taman Salma Shofa 1" class="about-image">
                                </div>
                                <!-- Slide 2 -->
                                <div class="swiper-slide">
                                    <img src="assets/Card1.png" alt="Taman Salma Shofa 2" class="about-image">
                                </div>
                                <!-- Slide 3 -->
                                <div class="swiper-slide">
                                    <img src="assets/Card2.png" alt="Taman Salma Shofa 3" class="about-image">
                                </div>
                                <!-- Slide 4 -->
                                <div class="swiper-slide">
                                    <img src="assets/InformasiUmum-Pengunjung.png" alt="Taman Salma Shofa 4" class="about-image">
                                </div>
                                <!-- Slide 5 -->
                                <div class="swiper-slide">
                                    <img src="assets/map_bg.png" alt="Taman Salma Shofa 5" class="about-image">
                                </div>
                            </div>

                            <!-- Navigation Arrows -->
                            <div class="swiper-button-prev carousel-nav-btn absolute left-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-[#E88D57] cursor-pointer transition-all">
                                <i class="fa-solid fa-chevron-left"></i>
                            </div>
                            <div class="swiper-button-next carousel-nav-btn absolute right-4 top-1/2 -translate-y-1/2 z-10 w-12 h-12 bg-white/80 hover:bg-white rounded-full flex items-center justify-center text-[#E88D57] cursor-pointer transition-all">
                                <i class="fa-solid fa-chevron-right"></i>
                            </div>

                            <!-- Pagination Dots -->
                            <div class="swiper-pagination absolute bottom-4 z-10 flex gap-2 justify-center w-full"></div>
                        </div>

                        <!-- Image Counter -->
                        <div class="absolute bottom-4 left-4 bg-black/60 px-4 py-2 rounded-full text-white text-sm z-10">
                            <span class="carousel-counter">1</span> / 5
                        </div>
                    </div>

                    <!-- Image Descriptions -->
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-5 gap-4">
                        <div class="text-center p-4 rounded-lg hover:bg-[#E88D57]/10 transition cursor-pointer carousel-thumbnail" data-index="0">
                            <img src="assets/hero.png" alt="Thumbnail 1" class="w-full h-24 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">Pemandangan Umum</p>
                        </div>
                        <div class="text-center p-4 rounded-lg hover:bg-[#E88D57]/10 transition cursor-pointer carousel-thumbnail" data-index="1">
                            <img src="assets/Card1.png" alt="Thumbnail 2" class="w-full h-24 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">Area Bermain</p>
                        </div>
                        <div class="text-center p-4 rounded-lg hover:bg-[#E88D57]/10 transition cursor-pointer carousel-thumbnail" data-index="2">
                            <img src="assets/Card2.png" alt="Thumbnail 3" class="w-full h-24 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">Fasilitas</p>
                        </div>
                        <div class="text-center p-4 rounded-lg hover:bg-[#E88D57]/10 transition cursor-pointer carousel-thumbnail" data-index="3">
                            <img src="assets/InformasiUmum-Pengunjung.png" alt="Thumbnail 4" class="w-full h-24 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">Informasi Pengunjung</p>
                        </div>
                        <div class="text-center p-4 rounded-lg hover:bg-[#E88D57]/10 transition cursor-pointer carousel-thumbnail" data-index="4">
                            <img src="assets/map_bg.png" alt="Thumbnail 5" class="w-full h-24 object-cover rounded mb-2">
                            <p class="text-sm text-gray-600">Lokasi Taman</p>
                        </div>
                    </div>
                </div>

                <!-- Stats Section -->
                <div class="bg-[#2B2B43] rounded-lg px-8 py-12 mb-16">
                    <h3 class="text-2xl font-bold text-white mb-8 text-center">Pencapaian Kami</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-[#E88D57] mb-2">5K+</div>
                            <p class="text-[#EAA07E]">Pengunjung/Bulan</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-[#E88D57] mb-2">50+</div>
                            <p class="text-[#EAA07E]">Fasilitas</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-[#E88D57] mb-2">24/7</div>
                            <p class="text-[#EAA07E]">Layanan Pelanggan</p>
                        </div>
                        <div class="text-center">
                            <div class="text-4xl font-bold text-[#E88D57] mb-2">100%</div>
                            <p class="text-[#EAA07E]">Kepuasan</p>
                        </div>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="bg-gradient-to-r from-[#E88D57] to-[#d97b3a] rounded-lg px-8 py-12 text-center">
                    <h3 class="text-2xl md:text-3xl font-bold text-white mb-4">Bersiaplah untuk Pengalaman Tak Terlupakan</h3>
                    <p class="text-white/90 mb-6">Kunjungi Taman Salma Shofa dan rasakan keseruan bersama keluarga Anda</p>
                    <div class="flex flex-col md:flex-row gap-4 justify-center">
                        <a href="pricelist.php" class="bg-white text-[#E88D57] px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">Lihat Paket Harga</a>
                        <a href="#" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white/10 transition">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <?php include __DIR__ . '/../includes/footer.php'; ?>

    <!-- Carousel Scripts -->
    <script>
        window.addEventListener('load', function() {
            if (typeof Swiper === 'undefined') {
                console.error('Swiper library tidak ditemukan. Periksa koneksi CDN atau file Swiper.');
                return;
            }

            const swiper = new Swiper('.carousel-swiper', {
                loop: true,
                speed: 700,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                touchRatio: 1.5,
                grabCursor: true,
                simulateTouch: true,
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                    renderBullet: function (index, className) {
                        return '<span class="' + className + ' w-3 h-3 bg-white/60 hover:bg-white rounded-full cursor-pointer transition"></span>';
                    },
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'slide',
                on: {
                    init: function() {
                        updateCounter(this);
                    },
                    slideChange: function() {
                        updateCounter(this);
                    }
                }
            });

            function updateCounter(swiperInstance) {
                const counter = document.querySelector('.carousel-counter');
                if (!counter) return;
                counter.textContent = (swiperInstance ? swiperInstance.realIndex : 0) + 1;
            }

            document.querySelectorAll('.carousel-thumbnail').forEach((thumbnail, index) => {
                thumbnail.addEventListener('click', () => {
                    if (typeof swiper.slideToLoop === 'function') {
                        swiper.slideToLoop(index);
                    } else {
                        swiper.slideTo(index + swiper.loopedSlides);
                    }
                });
            });
        });
    </script>

</body>
</html>
