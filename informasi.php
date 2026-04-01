<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Umum - Taman Salma Shofa</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="font-sans antialiased bg-white text-gray-800">

    <?php include 'includes/navbar.php'; ?>

    <!-- SECTION 1: TENTANG KAMI -->
    <section class="max-w-7xl mx-auto px-6 pt-16 pb-12 overflow-hidden">
        <div class="flex flex-col lg:flex-row gap-12 lg:gap-16 items-start">
            
            <!-- Kiri: Teks & Informasi -->
            <div class="w-full lg:w-[50%] pt-4">
                <!-- Badge -->
                <div class="bg-brand-orangeLight text-brand-orange px-3 py-1.5 rounded-md text-[10px] font-bold uppercase tracking-widest w-max mb-6">
                    Sejarah & Rekreasi
                </div>
                
                <h1 class="text-[40px] font-bold text-[#1a1a24] mb-6 leading-tight">
                    Tentang Taman Salma<br>Shofa
                </h1>
                
                <div class="text-brand-greyDark space-y-4 mb-10 text-[14.5px] leading-[1.8]">
                    <p>
                        Taman Salma Shofa merupakan tempat rekreasi keluarga yang telah beroperasi sejak tahun 2006. Awalnya tempat ini merupakan area kebun dan ruang pamer tanaman hias yang kemudian berkembang menjadi tempat rekreasi kolam renang dan tempat berkumpul bagi masyarakat pada tahun 2010.
                    </p>
                    <p>
                        Tempat ini terletak sekitar 4,5 km dari gerbang Mugirejo dan terus berkembang menjadi salah satu alternatif wisata keluarga di Samarinda.
                    </p>
                </div>

                <!-- Info Icons -->
                <div class="flex flex-wrap gap-8 mb-10 border-b border-gray-100 pb-10">
                    <div class="flex items-center gap-2.5 text-[13px] font-semibold text-[#1a1a24]">
                        <i class="fa-regular fa-clock text-brand-orange text-lg"></i>
                        Beroperasi Sejak 2006
                    </div>
                    <div class="flex items-center gap-2.5 text-[13px] font-semibold text-[#1a1a24]">
                        <i class="fa-solid fa-people-roof text-brand-orange text-lg"></i>
                        Ramah Keluarga
                    </div>
                </div>

                <!-- Visi & Nilai Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Visi Kami -->
                    <div class="bg-white p-6 rounded-xl border-t-[3px] border-brand-orange shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)]">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded bg-brand-orangeLight flex items-center justify-center text-brand-orange">
                                <i class="fa-regular fa-lightbulb"></i>
                            </div>
                            <h3 class="font-bold text-[#1a1a24] text-[15px]">Visi Kami</h3>
                        </div>
                        <p class="text-[12px] text-[#6b6b7b] leading-[1.8]">
                            Menjadi rahim lahirnya ide-ide produktif, kreatif & inovatif demi kemajuan kota Samarinda dengan menyediakan ruang yang menginspirasi setiap pengunjung.
                        </p>
                    </div>

                    <!-- Nilai Kami -->
                    <div class="bg-white p-6 rounded-xl border-t-[3px] border-brand-navy shadow-[0_2px_15px_-3px_rgba(0,0,0,0.05)]">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-8 h-8 rounded bg-gray-100 flex items-center justify-center text-gray-600">
                                <i class="fa-solid fa-users text-sm"></i>
                            </div>
                            <h3 class="font-bold text-[#1a1a24] text-[15px]">Nilai Kami</h3>
                        </div>
                        <p class="text-[12px] text-[#6b6b7b] leading-[1.8]">
                            Dibangun di atas semangat kekeluargaan, gotong royong, dan rasa memiliki kolektif yang menjadi motor penggerak utama dalam melayani masyarakat.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Kanan: Gambar Placeholder -->
            <div class="w-full lg:w-[50%] flex justify-end relative mt-6 lg:mt-0">
                <div class="relative z-10 w-full max-w-[550px] aspect-[4/3] rounded-2xl p-2 bg-white orange-glow">
                    <!-- Checkerboard -->
                    <div class="w-full h-full rounded-xl checkerboard-bg border border-gray-100"></div>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: GALERI (Grid) -->
    <section class="max-w-7xl mx-auto px-6 pb-20">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-5">
            <!-- 6 Gambar Taman -->
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 1" class="w-full h-52 object-cover rounded-2xl">
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 2" class="w-full h-52 object-cover rounded-2xl">
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 3" class="w-full h-52 object-cover rounded-2xl">
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 4" class="w-full h-52 object-cover rounded-2xl">
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 5" class="w-full h-52 object-cover rounded-2xl">
            <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Taman 6" class="w-full h-52 object-cover rounded-2xl">
        </div>
    </section>

    <!-- SECTION 3: KEUNGGULAN, AKTIVITAS & FOOTER -->
    <section class="bg-brand-navy text-white pt-20 pb-8">
        <div class="max-w-7xl mx-auto px-6">
            
            <!-- Baris Atas: Keunggulan & Aktivitas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-20">
                
                <!-- Kiri: Keunggulan Kami -->
                <div>
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-6 h-[2px] bg-brand-orange"></div>
                        <h2 class="text-lg font-bold tracking-widest uppercase text-white">Keunggulan Kami</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- Card 1 -->
                        <div class="bg-brand-card p-6 rounded-xl">
                            <div class="text-brand-orange mb-4"><i class="fa-regular fa-face-smile text-[22px]"></i></div>
                            <h3 class="font-semibold text-[15px] mb-2 text-white">Ramah Semua Usia</h3>
                            <p class="text-brand-greyText text-[12px] leading-relaxed">Fasilitas yang dirancang aman dan nyaman untuk anak-anak hingga lansia.</p>
                        </div>
                        
                        <!-- Card 2 -->
                        <div class="bg-brand-card p-6 rounded-xl">
                            <div class="text-brand-orange mb-4"><i class="fa-solid fa-utensils text-[22px]"></i></div>
                            <h3 class="font-semibold text-[15px] mb-2 text-white">Bawa Makanan Luar</h3>
                            <p class="text-brand-greyText text-[12px] leading-relaxed">Kebebasan membawa bekal favorit keluarga untuk dinikmati di area taman.</p>
                        </div>

                        <!-- Card 3 -->
                        <div class="bg-brand-card p-6 rounded-xl">
                            <div class="text-brand-orange mb-4"><i class="fa-solid fa-graduation-cap text-[22px]"></i></div>
                            <h3 class="font-semibold text-[15px] mb-2 text-white">Rekreasi & Edukasi</h3>
                            <p class="text-brand-greyText text-[12px] leading-relaxed">Perpaduan pas antara hiburan dan pembelajaran di lingkungan alam.</p>
                        </div>

                        <!-- Card 4 -->
                        <div class="bg-brand-card p-6 rounded-xl">
                            <div class="text-brand-orange mb-4"><i class="fa-solid fa-tree-city text-[22px]"></i></div>
                            <h3 class="font-semibold text-[15px] mb-2 text-white">Lingkungan Asri</h3>
                            <p class="text-brand-greyText text-[12px] leading-relaxed">Suasana alami yang rimbun dan tenang, jauh dari hiruk pikuk kota.</p>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Aktivitas & Pengalaman -->
                <div class="lg:pl-6">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="w-6 h-[2px] bg-brand-orange"></div>
                        <h2 class="text-lg font-bold tracking-widest uppercase text-white">Aktivitas & Pengalaman</h2>
                    </div>

                    <div class="flex flex-col gap-5 mt-4">
                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 rounded-full bg-brand-card flex items-center justify-center text-brand-orange shrink-0">
                                <i class="fa-solid fa-water"></i>
                            </div>
                            <p class="text-[14px] font-medium text-[#F4F4F5] tracking-wide">Berenang di berbagai jenis kolam</p>
                        </div>
                        
                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 rounded-full bg-brand-card flex items-center justify-center text-brand-orange shrink-0">
                                <i class="fa-solid fa-user-group"></i>
                            </div>
                            <p class="text-[14px] font-medium text-[#F4F4F5] tracking-wide">Berkumpul bersama keluarga tercinta</p>
                        </div>

                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 rounded-full bg-brand-card flex items-center justify-center text-brand-orange shrink-0">
                                <i class="fa-regular fa-calendar-days"></i>
                            </div>
                            <p class="text-[14px] font-medium text-[#F4F4F5] tracking-wide">Mengadakan acara atau gathering komunitas</p>
                        </div>

                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 rounded-full bg-brand-card flex items-center justify-center text-brand-orange shrink-0">
                                <i class="fa-solid fa-person-running"></i>
                            </div>
                            <p class="text-[14px] font-medium text-[#F4F4F5] tracking-wide">Outbond dan kegiatan kelompok seru</p>
                        </div>

                        <div class="flex items-center gap-5">
                            <div class="w-10 h-10 rounded-full bg-brand-card flex items-center justify-center text-brand-orange shrink-0">
                                <i class="fa-solid fa-camera-retro"></i>
                            </div>
                            <p class="text-[14px] font-medium text-[#F4F4F5] tracking-wide">Berfoto di berbagai spot estetik & menarik</p>
                        </div>
                    </div>
                </div>

            </div>

            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>