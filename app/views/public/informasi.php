<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Umum - Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAFB] text-gray-800 flex flex-col min-h-screen">

    <?php include 'includes/navbar.php'; ?>

    <section class="max-w-[1200px] mx-auto px-6 md:px-12 py-16 md:py-24">
        <div class="flex flex-col lg:flex-row items-center gap-16">
            
            <div class="w-full lg:w-1/2">
                <span class="inline-block bg-[#FEF0E6] text-[#E88D57] px-4 py-1.5 rounded-full text-[11px] font-bold uppercase tracking-widest mb-6">
                    Sejarah & Rekreasi
                </span>
                <h1 class="text-[36px] md:text-[44px] font-extrabold text-[#1a1a24] leading-tight mb-6">
                    Tentang Taman Salma Shofa
                </h1>
                <div class="text-gray-600 text-[15px] leading-[1.8] space-y-4 mb-8">
                    <p>
                        Taman Salma Shofa merupakan tempat rekreasi keluarga yang telah beroperasi sejak tahun 2006. Awalnya tempat ini merupakan area kebun dan ruang pamer tanaman hias yang kemudian berkembang menjadi tempat rekreasi kolam renang dan tempat berkumpul bagi masyarakat pada tahun 2010.
                    </p>
                    <p>
                        Tempat ini terletak sekitar 4,5 km dari gerbang Mugirejo dan terus berkembang menjadi salah satu alternatif wisata keluarga di Samarinda.
                    </p>
                </div>
                
                <div class="flex flex-wrap items-center gap-6 text-[14px] font-semibold text-[#1a1a24]">
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-circle-check text-[#E88D57] text-[18px]"></i>
                        Beroperasi Sejak 2006
                    </div>
                    <div class="flex items-center gap-2">
                        <i class="fa-solid fa-people-roof text-[#E88D57] text-[18px]"></i>
                        Ramah Keluarga
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-1/2 relative">
                <div class="absolute inset-0 bg-[#E88D57] blur-[60px] opacity-30 rounded-[30px] transform scale-95"></div>
                
                <img src="assets/InformasiUmum-Pengunjung.png" 
                     alt="Tentang Taman Salma Shofa" 
                     class="relative z-10 w-full h-[350px] md:h-[450px] object-cover rounded-[30px] shadow-xl">
            </div>

        </div>
    </section>

    <section class="max-w-[1200px] mx-auto px-6 md:px-12 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            <div class="bg-white rounded-2xl p-8 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.08)] border-t-[5px] border-[#E88D57] flex gap-5 items-start">
                <div class="w-14 h-14 shrink-0 bg-[#FEF0E6] rounded-xl flex items-center justify-center text-[#E88D57] text-[24px]">
                    <i class="fa-regular fa-lightbulb"></i>
                </div>
                <div>
                    <h3 class="text-[20px] font-bold text-[#1a1a24] mb-3">Visi Kami</h3>
                    <p class="text-gray-500 text-[14px] leading-relaxed">
                        Menjadi rahim lahirnya ide-ide produktif, kreatif & inovatif demi kemajuan kota Samarinda dengan menyediakan ruang yang menginspirasi setiap pengunjung.
                    </p>
                </div>
            </div>

            <div class="bg-white rounded-2xl p-8 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.08)] border-t-[5px] border-[#2B2B43] flex gap-5 items-start">
                <div class="w-14 h-14 shrink-0 bg-[#F4F4F6] rounded-xl flex items-center justify-center text-[#2B2B43] text-[20px]">
                    <i class="fa-solid fa-users"></i>
                </div>
                <div>
                    <h3 class="text-[20px] font-bold text-[#1a1a24] mb-3">Nilai Kami</h3>
                    <p class="text-gray-500 text-[14px] leading-relaxed">
                        Dibangun di atas semangat kekeluargaan, gotong royong, dan rasa memiliki kolektif yang menjadi motor penggerak utama dalam melayani masyarakat.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="max-w-[1200px] mx-auto px-6 md:px-12 pb-24">
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4 md:gap-6">
            <img src="https://images.unsplash.com/photo-1584310543632-47530c33a216?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 1" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm">
            <img src="https://images.unsplash.com/photo-1596436889106-be35e843f974?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 2" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm">
            <img src="https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 3" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm">
            <img src="https://images.unsplash.com/photo-1505322022379-7c3353ee6291?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 4" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm hidden md:block">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 5" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm hidden md:block">
            <img src="https://images.unsplash.com/photo-1572095694292-1c2ce0d3c0de?ixlib=rb-4.0.3&auto=format&fit=crop&w=600&q=80" alt="Galeri 6" class="w-full h-[180px] md:h-[250px] object-cover rounded-3xl shadow-sm hidden md:block">
        </div>
    </section>

    <section class="bg-[#2B2B43] py-20 px-6 md:px-12 w-full">
        <div class="max-w-[1200px] mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24">
            
            <div>
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-1 bg-[#E88D57] rounded-full"></div>
                    <h2 class="text-white text-[18px] font-bold tracking-widest uppercase">Keunggulan Kami</h2>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="bg-[#363650] p-6 rounded-[20px] border border-white/5 hover:-translate-y-1 transition-transform">
                        <i class="fa-regular fa-face-smile text-[#E88D57] text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Ramah Semua Usia</h4>
                        <p class="text-gray-400 text-[13px] leading-relaxed">Fasilitas yang dirancang aman dan nyaman untuk anak-anak hingga lansia.</p>
                    </div>
                    <div class="bg-[#363650] p-6 rounded-[20px] border border-white/5 hover:-translate-y-1 transition-transform">
                        <i class="fa-solid fa-utensils text-[#E88D57] text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Bawa Makanan Luar</h4>
                        <p class="text-gray-400 text-[13px] leading-relaxed">Kebebasan membawa bekal favorit keluarga untuk dinikmati di area taman.</p>
                    </div>
                    <div class="bg-[#363650] p-6 rounded-[20px] border border-white/5 hover:-translate-y-1 transition-transform">
                        <i class="fa-solid fa-graduation-cap text-[#E88D57] text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Rekreasi & Edukasi</h4>
                        <p class="text-gray-400 text-[13px] leading-relaxed">Paduan sempurna antara hiburan dan pembelajaran di lingkungan alam.</p>
                    </div>
                    <div class="bg-[#363650] p-6 rounded-[20px] border border-white/5 hover:-translate-y-1 transition-transform">
                        <i class="fa-solid fa-tree text-[#E88D57] text-[24px] mb-4"></i>
                        <h4 class="text-white font-bold text-[15px] mb-2">Lingkungan Asri</h4>
                        <p class="text-gray-400 text-[13px] leading-relaxed">Suasana alami yang rimbun dan tenang, jauh dari hiruk-pikuk kota.</p>
                    </div>
                </div>
            </div>

            <div>
                <div class="flex items-center gap-4 mb-10">
                    <div class="w-10 h-1 bg-[#E88D57] rounded-full"></div>
                    <h2 class="text-white text-[18px] font-bold tracking-widest uppercase">Aktivitas & Pengalaman</h2>
                </div>

                <div class="flex flex-col gap-6">
                    <div class="flex items-center gap-5">
                        <div class="w-[50px] h-[50px] rounded-full bg-[#E88D57]/10 border border-[#E88D57]/20 flex items-center justify-center text-[#E88D57] text-[20px] shrink-0">
                            <i class="fa-solid fa-person-swimming"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berenang di berbagai jenis kolam</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[50px] h-[50px] rounded-full bg-[#E88D57]/10 border border-[#E88D57]/20 flex items-center justify-center text-[#E88D57] text-[18px] shrink-0">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berkumpul bersama keluarga tercinta</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[50px] h-[50px] rounded-full bg-[#E88D57]/10 border border-[#E88D57]/20 flex items-center justify-center text-[#E88D57] text-[18px] shrink-0">
                            <i class="fa-regular fa-calendar-check"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Mengadakan acara atau gathering komunitas</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[50px] h-[50px] rounded-full bg-[#E88D57]/10 border border-[#E88D57]/20 flex items-center justify-center text-[#E88D57] text-[18px] shrink-0">
                            <i class="fa-solid fa-person-hiking"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Outbond dan kegiatan kelompok seru</span>
                    </div>
                    <div class="flex items-center gap-5">
                        <div class="w-[50px] h-[50px] rounded-full bg-[#E88D57]/10 border border-[#E88D57]/20 flex items-center justify-center text-[#E88D57] text-[18px] shrink-0">
                            <i class="fa-solid fa-camera-retro"></i>
                        </div>
                        <span class="text-white text-[15px] font-medium">Berfoto di berbagai spot estetik & menarik</span>
                    </div>
                </div>
            </div>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>