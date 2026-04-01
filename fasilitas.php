<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fasilitas & Layanan - Taman Salma Shofa</title>
    
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

    <!-- SECTION 1: FASILITAS KAMI -->
    <section class="max-w-7xl mx-auto px-6 pt-12 pb-16">
        
        <!-- Header Section -->
        <div class="mb-10">
            <div class="border-l-[3px] border-[#e88d57] pl-4 mb-4">
                <h1 class="text-3xl font-bold text-[#1a1a24]">Fasilitas Kami</h1>
            </div>
            <p class="text-brand-greyDark text-[13.5px] leading-relaxed max-w-3xl">
                Nikmati berbagai fasilitas menarik untuk rekreasi, bersantai, hingga acara khusus bersama keluarga dan komunitas. Tersedia fasilitas umum serta pilihan area eksklusif yang dapat disewa sesuai kebutuhan Anda.
            </p>
        </div>

        <!-- Horizontal Scroll Cards (Fasilitas Utama) -->
        <div class="flex overflow-x-auto hide-scroll gap-6 pb-6 -mx-6 px-6 lg:mx-0 lg:px-0 lg:grid lg:grid-cols-3">
            
            <!-- Card 1: Kolam Renang -->
            <div class="w-[300px] lg:w-full shrink-0 flex flex-col rounded-[18px] overflow-hidden shadow-sm">
                <!-- Image -->
                <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Kolam Renang" class="h-56 w-full object-cover">
                <!-- Content (Orange) -->
                <div class="bg-[#E88D57] p-6 flex-1 text-white">
                    <h3 class="font-bold text-[17px] mb-4">Kolam Renang</h3>
                    <ul class="space-y-3 text-[12px] text-white/95">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">5 Area Kolam Terpisah</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Berbagai kedalaman: 40cm, 60cm, 90cm, 120cm, dan 150cm</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Area bermain air ramah anak</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Card 2: Beranda Gallery -->
            <div class="w-[300px] lg:w-full shrink-0 flex flex-col rounded-[18px] overflow-hidden shadow-sm">
                <!-- Image -->
                <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Beranda Gallery" class="h-56 w-full object-cover">
                <!-- Content (Orange) -->
                <div class="bg-[#E88D57] p-6 flex-1 text-white">
                    <h3 class="font-bold text-[17px] mb-4">Beranda Gallery</h3>
                    <ul class="space-y-3 text-[12px] text-white/95">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Menampilkan koleksi budaya & barang antik</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Tersedia sewa kostum tradisional</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Spot foto unik & estetik</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Card 3: Odah Betang -->
            <div class="w-[300px] lg:w-full shrink-0 flex flex-col rounded-[18px] overflow-hidden shadow-sm">
                <!-- Image -->
                <img src="https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Odah Betang" class="h-56 w-full object-cover">
                <!-- Content (Orange) -->
                <div class="bg-[#E88D57] p-6 flex-1 text-white">
                    <h3 class="font-bold text-[17px] mb-4">Odah Betang</h3>
                    <ul class="space-y-3 text-[12px] text-white/95">
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Ruangan multifungsi gaya rumah adat</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Cocok untuk arisan, rapat, atau acara keluarga</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <i class="fa-solid fa-check text-[10px] mt-1 shrink-0 text-white"></i>
                            <span class="leading-relaxed">Disewakan eksklusif</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- SECTION 2: FASILITAS LAINNYA -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        
        <!-- Header -->
        <div class="border-l-[3px] border-[#e88d57] pl-4 mb-10">
            <h2 class="text-2xl font-bold text-[#1a1a24]">Fasilitas Lainnya</h2>
        </div>

        <!-- Grid 4 Kolom -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            <!-- Item 1 -->
            <div class="flex flex-col text-center">
                <div class="w-full aspect-square rounded-[20px] checkerboard-bg mb-4 border border-gray-100"></div>
                <h4 class="font-bold text-[13px] text-[#1a1a24] mb-1.5">Parkiran Luas</h4>
                <p class="text-[11px] text-brand-greyDark px-2">Dapat menampung 30 mobil dan 100 motor</p>
            </div>
            
            <!-- Item 2 -->
            <div class="flex flex-col text-center">
                <div class="w-full aspect-square rounded-[20px] checkerboard-bg mb-4 border border-gray-100"></div>
                <h4 class="font-bold text-[13px] text-[#1a1a24] mb-1.5">Parkiran Luas</h4>
                <p class="text-[11px] text-brand-greyDark px-2">Dapat menampung 30 mobil dan 100 motor</p>
            </div>

            <!-- Item 3 -->
            <div class="flex flex-col text-center">
                <div class="w-full aspect-square rounded-[20px] checkerboard-bg mb-4 border border-gray-100"></div>
                <h4 class="font-bold text-[13px] text-[#1a1a24] mb-1.5">Parkiran Luas</h4>
                <p class="text-[11px] text-brand-greyDark px-2">Dapat menampung 30 mobil dan 100 motor</p>
            </div>

            <!-- Item 4 -->
            <div class="flex flex-col text-center">
                <div class="w-full aspect-square rounded-[20px] checkerboard-bg mb-4 border border-gray-100"></div>
                <h4 class="font-bold text-[13px] text-[#1a1a24] mb-1.5">Parkiran Luas</h4>
                <p class="text-[11px] text-brand-greyDark px-2">Dapat menampung 30 mobil dan 100 motor</p>
            </div>
        </div>

    </section>

    <!-- SECTION 3: LAYANAN SPESIAL (Sewa Baju Tradisional) -->
    <section class="max-w-7xl mx-auto px-6 pb-24">
        
        <!-- Dark Navy Card -->
        <!-- Penggunaan md:flex-row agar KIRI-KANAN bertahan di ukuran layar medium (tablet/laptop kecil) -->
        <div class="bg-brand-navy rounded-[28px] p-8 md:p-14 relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-10 md:gap-8 shadow-lg">
            
            <!-- Background Besar Huruf 'S' (Dekoratif) - Posisi di Kanan Belakang Gambar -->
            <div class="absolute right-[5%] top-1/2 -translate-y-1/2 text-[450px] font-serif font-bold text-white/[0.04] select-none pointer-events-none leading-none z-0">
                S
            </div>

            <!-- KIRI: Deskripsi & Harga -->
            <div class="w-full md:w-[48%] relative z-10 pt-2">
                <p class="text-[#E88D57] text-[10px] font-bold tracking-[0.2em] uppercase mb-4">Layanan Spesial</p>
                
                <h2 class="text-[32px] md:text-[40px] font-bold text-white mb-6 leading-[1.15]">
                    Sewa Baju<br>Tradisional
                </h2>
                
                <p class="text-[#D4D4D8] text-[13.5px] leading-[1.7] mb-8 max-w-[380px]">
                    Abadikan momen tak terlupakan dengan mengenakan busana tradisional mancanegara. Tersedia koleksi otentik untuk foto yang estetik.
                </p>
                
                <!-- Kotak Harga -->
                <div class="bg-[#37374F]/80 rounded-[14px] p-5 inline-block border border-white/5 shadow-inner">
                    <p class="text-[#A1A1AA] text-[11px] mb-1.5 font-medium tracking-wide">Harga Sewa Flat</p>
                    
                    <!-- Formating Harga Spesifik (Angka Besar, Garis miring & Teks di kanannya) -->
                    <div class="flex items-center gap-2">
                        <p class="text-white text-[28px] font-bold leading-none tracking-tight">Rp 30.000</p>
                        <div class="flex flex-col justify-center text-[#A1A1AA] text-[10px] font-medium leading-[1.1]">
                            <span>/</span>
                            <span>kostum</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- KANAN: Grid Gambar 2 Kolom -->
            <div class="w-full md:w-[48%] relative z-10 flex gap-4 h-[300px] md:h-[340px]">
                
                <!-- Kolom 1 (Kiri grid): 2 Gambar Bertumpuk -->
                <div class="w-1/2 flex flex-col gap-4">
                    <!-- Yukata / Kimono -->
                    <div class="flex-1 rounded-[16px] checkerboard-bg relative shadow-md border border-white/10 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2B2B43]/90 via-[#2B2B43]/20 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-[11px] font-bold z-20">Yukata / Kimono</div>
                    </div>
                    
                    <!-- Hanbok -->
                    <div class="flex-1 rounded-[16px] checkerboard-bg relative shadow-md border border-white/10 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#2B2B43]/90 via-[#2B2B43]/20 to-transparent"></div>
                        <div class="absolute bottom-4 left-4 text-white text-[11px] font-bold z-20">Hanbok</div>
                    </div>
                </div>

                <!-- Kolom 2 (Kanan grid): 1 Gambar Tinggi Penuh -->
                <div class="w-1/2 h-full rounded-[16px] checkerboard-bg relative shadow-md border border-white/10 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#2B2B43]/90 via-[#2B2B43]/20 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white text-[11px] font-bold z-20">Noni Belanda</div>
                </div>

            </div>

        </div>

    </section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>