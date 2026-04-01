<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taman Salma Shofa</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="font-sans text-gray-800 antialiased bg-white">

    <!-- HERO & NAVIGATION SECTION -->
    <section class="relative h-[60vh] min-h-[400px] w-full bg-[#2B2B43] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1576013551627-1422ab1a0f44?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80');">
        <!-- Overlay gelap agar teks navbar terbaca -->
        <div class="absolute inset-0 bg-black/40"></div>

        <!-- Navigation Bar -->
        <?php include 'includes/navbar.php'; ?>
    </section>

    <!-- WELCOME & CARDS SECTION -->
    <section class="max-w-6xl mx-auto px-6 py-16 text-center">
        <h1 class="text-4xl font-semibold mb-3">Selamat Datang di Taman Salma Shofa</h1>
        <p class="text-gray-500 mb-12">Jika bukan karena kasih sayang, rasanya berat dapat dikerjakan.</p>

        <div class="grid md:grid-cols-2 gap-6 text-left">
            <!-- Card 1: Info Lengkap -->
            <div class="relative h-56 rounded-xl overflow-hidden shadow-md group cursor-pointer bg-gray-200">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-brand-orange via-brand-orange/80 to-transparent"></div>
                <!-- Content -->
                <div class="relative h-full flex flex-col justify-center p-8 w-3/4">
                    <h3 class="text-white text-2xl font-semibold mb-2 shadow-sm">Info Lengkap Wisata</h3>
                    <p class="text-white/90 text-sm mb-6">Temukan info lengkap tentang Taman Salma Shofa</p>
                    <button class="w-max px-6 py-2 bg-white/20 backdrop-blur-sm border border-white/40 text-white text-sm rounded hover:bg-white hover:text-brand-orange transition-colors">
                        Selengkapnya
                    </button>
                </div>
            </div>

            <!-- Card 2: Cek Ketersediaan -->
            <div class="relative h-56 rounded-xl overflow-hidden shadow-md group cursor-pointer bg-gray-200">
                <!-- Background Image -->
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-500 group-hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1499793983690-e29da59ef1c2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                <!-- Gradient Overlay -->
                <div class="absolute inset-0 bg-gradient-to-r from-brand-orange via-brand-orange/80 to-transparent"></div>
                <!-- Content -->
                <div class="relative h-full flex flex-col justify-center p-8 w-3/4">
                    <h3 class="text-white text-2xl font-semibold mb-2">Cek Ketersediaan Gazebo</h3>
                    <p class="text-white/90 text-sm mb-6">Lihat ketersediaan gazebo secara real-time</p>
                    <button class="w-max px-6 py-2 bg-brand-orange border border-white/20 text-white text-sm rounded hover:bg-orange-500 transition-colors shadow-sm">
                        Cek Sekarang
                    </button>
                </div>
            </div>
        </div>
    </section>

    <!-- INFO BAR SECTION -->
    <div class="border-y border-gray-200">
        <section class="max-w-6xl mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-0 md:divide-x divide-gray-300">
                
                <!-- Info 1: Jam Operasional -->
                <div class="flex gap-4 px-4 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-regular fa-clock text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Jam Operasional</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p class="flex justify-between w-40"><span>Selasa - Minggu:</span> <span>08.00 - 17.00</span></p>
                            <p>Senin Tutup (kecuali tanggal merah)</p>
                            <p>Loket tiket tutup pukul 16.00</p>
                        </div>
                    </div>
                </div>

                <!-- Info 2: Harga Tiket -->
                <div class="flex gap-4 px-4 md:px-8 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-solid fa-rupiah-sign text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Harga Tiket</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>Rp25.000 / orang</p>
                            <p>Berlaku untuk anak-anak dan dewasa.</p>
                            <p>Harga sewa alat renang opsional.</p>
                        </div>
                    </div>
                </div>

                <!-- Info 3: Ketentuan -->
                <div class="flex gap-4 px-4 md:px-8 items-start">
                    <div class="mt-1 text-gray-700">
                        <i class="fa-solid fa-circle-info text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-lg mb-2">Ketentuan Pengunjung</h4>
                        <div class="text-sm text-gray-600 space-y-1">
                            <p>Tiket berlaku mulai usia 1,5 tahun.</p>
                            <p>Tiket sudah termasuk akses kolam renang.</p>
                            <p>Pengunjung boleh membawa makanan dan minuman dari luar.</p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    <!-- LOCATION SECTION -->
    <section class="max-w-6xl mx-auto px-6 py-16">
        <div class="flex items-center gap-2 mb-6">
            <i class="fa-solid fa-location-dot text-brand-orange text-xl"></i>
            <h2 class="text-2xl font-bold">Lokasi Kami</h2>
        </div>

        <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm flex flex-col">
            <!-- Map Placeholder Area -->
            <div class="relative bg-gray-100 w-full h-[400px] p-4 bg-cover bg-center" style="background-image: url('https://www.google.com/maps/d/thumbnail?mid=1vX-w2Q1rJ8G6yX8zH7O1iZ5rK_c&hl=en_US');">
                
                <!-- Mockup Map UI Elements to match image -->
                <div class="absolute top-4 left-4 bg-white px-3 py-2 rounded shadow text-xs flex flex-col gap-1">
                    <span class="font-semibold text-gray-800">JL. MUJAHIDIN, RT. 17 KM 4.5, LOA BAKUNG, KOTA SAMARINDA</span>
                    <a href="#" class="text-blue-600 hover:underline flex items-center gap-1">Open in Maps <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i></a>
                </div>
                
                <!-- Center Pin mockup -->
                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 text-center">
                    <i class="fa-solid fa-location-dot text-red-600 text-3xl drop-shadow-md"></i>
                    <p class="font-bold text-xs mt-1 bg-white/80 px-1 rounded">Taman Salma Shofa</p>
                </div>
            </div>

            <!-- Bottom Action Bar -->
            <div class="bg-brand-dark p-6 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 text-white">
                <div>
                    <h3 class="font-semibold text-lg">Taman Salma Shofa</h3>
                    <p class="text-gray-300 text-sm">Samarinda, Kalimantan Timur</p>
                </div>
                <button class="bg-brand-orange hover:bg-orange-500 text-white px-6 py-2.5 rounded shadow flex items-center gap-2 transition-colors">
                    <i class="fa-solid fa-diamond-turn-right"></i> Rute
                </button>
            </div>
        </div>
    </section>

    <!-- TESTIMONIAL SECTION -->
    <section class="bg-brand-light py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-brand-orange text-xs font-semibold tracking-widest uppercase">Testimoni</span>
                <h2 class="text-3xl font-bold mt-2">Ulasan Pengunjung</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8 items-stretch">
                
                <!-- Review 1 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="text-brand-orange text-sm mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-8">
                            "Disini banyak spot foto yang instagram-able, menarik. Kolam renang yang berbagai ukuran kedalaman, ada untuk anak dan dewasa. Tempat istirahat/pondokan yang gratis di pinggir kolam. Tempat bilas yang banyak, tidak takut antri lama, air lumayan deras. Ada khusus laki-laki dan perempuan."
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/150?img=47" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <span class="font-semibold text-sm">Dewi Minhajuhayati</span>
                    </div>
                </div>

                <!-- Review 2 (Highlighted) -->
                <div class="bg-brand-dark p-8 rounded-xl shadow-lg transform md:-translate-y-4 flex flex-col justify-between">
                    <div>
                        <div class="text-brand-orange text-sm mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <p class="text-gray-300 text-sm leading-relaxed mb-8">
                            "Tempatnya lumayan bersih, ada banyak penjual makanan tapi bawa makanan dari luar juga boleh, ada kursi-kursi gratis untuk menaruh tas bawaan, ada juga gazebo yg disewakan perjam/perhari. Ada kamar mandi untuk pria dan wanita (tidak dicampur). Kolamnya banyak, untuk anak anak sampai dewasa..."
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/150?img=11" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <span class="font-semibold text-sm text-white">Frimita Sadi</span>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-100 flex flex-col justify-between">
                    <div>
                        <div class="text-brand-orange text-sm mb-4">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                        <p class="text-gray-600 text-sm leading-relaxed mb-8">
                            "Tempat yang menarik, cocok buat keluarga yang mempunyai anak kecil, ada pilihan makanan, dan juga tersedia gazebo sesuai dengan kebutuhan. Biaya masuk 25 ribu/orang. Parkir 5 ribu untuk mobil. Kedalaman kolam maksimal 140 cm. Juga tersedia ruangan taman untuk pre wedding."
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <img src="https://i.pravatar.cc/150?img=68" alt="User" class="w-10 h-10 rounded-full object-cover">
                        <span class="font-semibold text-sm">Yusup Marwan</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FOOTER SECTION -->
    <?php include 'includes/footer.php'; ?>

</body>
</html>