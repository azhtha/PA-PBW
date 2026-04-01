<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Admin Taman Salma Shofa</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            navy: '#2B2B43',        // Sidebar background
                            orange: '#C6714A',      // Adjusted Orange from the specific design
                            lightOrange: '#FDF3ED', // Background orange ringan
                            bgLight: '#FAFAFB',     // Main background
                            textDark: '#1A1A24',    // Heading text
                            textMuted: '#6B7280',   // Gray text
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Sembunyikan scrollbar untuk area utama namun tetap bisa di-scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight relative">
        
        <div class="flex-1 overflow-y-auto no-scrollbar p-8 lg:p-10">
            <div class="max-w-[1200px] mx-auto">
                
                <!-- HEADER TITLE & ADD BUTTON -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-[32px] font-bold text-brand-textDark mb-1 leading-tight">Kelola Fasilitas</h1>
                        <p class="text-gray-500 text-[14px] leading-relaxed">Atur aset utama dan amenitas premium Taman Salma Shofa</p>
                    </div>
                    <button class="bg-brand-orange hover:bg-[#b0623f] text-white font-bold px-6 py-3 rounded-lg transition-colors shadow-sm flex items-center gap-2 text-[13px] shrink-0">
                        <i class="fa-solid fa-circle-plus"></i> Tambah Fasilitas Utama
                    </button>
                </div>

                <!-- FASILITAS UTAMA GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    
                    <!-- Card 1: Kolam Renang -->
                    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col">
                        <div class="relative w-full h-[180px] rounded-xl overflow-hidden mb-4">
                            <!-- Background Image Mockup -->
                            <div class="absolute inset-0 bg-slate-800 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1576013551627-1422ab1a0f44?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111]/90 via-[#111]/20 to-transparent"></div>
                            <!-- Decorative Center Element (Mocking the 'KOLAM Safe Resauf' text in the image) -->
                            <div class="absolute inset-0 flex items-center justify-center opacity-80">
                                <span class="font-serif text-3xl text-white font-bold tracking-widest uppercase">KOLAM</span>
                            </div>
                            <!-- Title Bottom Left -->
                            <h3 class="absolute bottom-4 left-4 text-white font-bold text-[18px] tracking-wide">Kolam Renang</h3>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto px-1">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                    <i class="fa-solid fa-pencil text-[12px]"></i>
                                </button>
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fa-regular fa-trash-can text-[12px]"></i>
                                </button>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400">Diperbarui 2 jam lalu</span>
                        </div>
                    </div>

                    <!-- Card 2: Odah Betemu -->
                    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col">
                        <div class="relative w-full h-[180px] rounded-xl overflow-hidden mb-4">
                            <!-- Background Image Mockup -->
                            <div class="absolute inset-0 bg-[#D4A373] bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1506880018603-83d5b814b5a6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111]/90 via-[#111]/20 to-transparent"></div>
                            <h3 class="absolute bottom-4 left-4 text-white font-bold text-[18px] tracking-wide">Odah Betemu</h3>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto px-1">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                    <i class="fa-solid fa-pencil text-[12px]"></i>
                                </button>
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fa-regular fa-trash-can text-[12px]"></i>
                                </button>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400">Diperbarui 1 hari lalu</span>
                        </div>
                    </div>

                    <!-- Card 3: Gazebo -->
                    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col">
                        <div class="relative w-full h-[180px] rounded-xl overflow-hidden mb-4">
                            <!-- Background Image Mockup -->
                            <div class="absolute inset-0 bg-emerald-800 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1596524430615-b46475ddff6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80');"></div>
                            <div class="absolute inset-0 bg-gradient-to-t from-[#111]/90 via-[#111]/20 to-transparent"></div>
                            <h3 class="absolute bottom-4 left-4 text-white font-bold text-[18px] tracking-wide">Gazebo</h3>
                        </div>
                        
                        <div class="flex items-center justify-between mt-auto px-1">
                            <div class="flex items-center gap-2">
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                    <i class="fa-solid fa-pencil text-[12px]"></i>
                                </button>
                                <button class="w-8 h-8 rounded border border-gray-200 flex items-center justify-center text-red-500 hover:bg-red-50 transition-colors">
                                    <i class="fa-regular fa-trash-can text-[12px]"></i>
                                </button>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400">Diperbarui 2 hari lalu</span>
                        </div>
                    </div>

                </div>

                <!-- FASILITAS LAINNYA HEADER & BUTTON -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-[22px] font-bold text-brand-textDark mb-0.5 leading-tight">Fasilitas Lainnya</h2>
                        <p class="text-gray-500 text-[13px] leading-relaxed">Layanan pendukung untuk kenyamanan pengunjung</p>
                    </div>
                    <button class="bg-[#F4F5F7] hover:bg-[#e9ecef] text-gray-700 font-bold px-5 py-2.5 rounded-lg border border-gray-200 transition-colors shadow-sm flex items-center gap-2 text-[13px] shrink-0">
                        <i class="fa-solid fa-plus text-[12px]"></i> Tambah Fasilitas Pendukung
                    </button>
                </div>

                <!-- FASILITAS LAINNYA GRID -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 mb-14">
                    
                    <!-- Sub-Card 1: Parkiran -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative bg-amber-900 overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60');"></div>
                            <!-- Delete Button Hovering over Image -->
                            <button class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </button>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5">Parkiran</h4>
                            <p class="text-[11px] text-gray-500 mb-4">50 mobil & 100 motor</p>
                            <button class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sub-Card 2: Ruang Ganti -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative bg-[#3C3836] overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1540541338287-41700207dee6?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'); opacity: 0.8;"></div>
                            <button class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </button>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5">Ruang Ganti</h4>
                            <p class="text-[11px] text-gray-500 mb-4">Pria & Wanita terpisah</p>
                            <button class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sub-Card 3: Toilet -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative bg-[#459B99] overflow-hidden flex items-center justify-center">
                            <!-- Placeholder icon instead of image to match style -->
                            <i class="fa-solid fa-restroom text-4xl text-white/50"></i>
                            <button class="absolute top-2 right-2 w-7 h-7 bg-black/20 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </button>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5">Toilet</h4>
                            <p class="text-[11px] text-gray-500 mb-4">12 Unit di 3 lokasi</p>
                            <button class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sub-Card 4: Mushola -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative bg-slate-900 overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1542816417-0983c9c9ad53?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60');"></div>
                            <button class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </button>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5">Mushola</h4>
                            <p class="text-[11px] text-gray-500 mb-4">Kapasitas 20 jamaah</p>
                            <button class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sub-Card 5: Kantin -->
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative bg-stone-800 overflow-hidden">
                            <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1555396273-367ea4eb4db5?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60');"></div>
                            <button class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </button>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5">Kantin</h4>
                            <p class="text-[11px] text-gray-500 mb-4">8 Tenant aktif tersedia</p>
                            <button class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-500 hover:bg-gray-50 transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </button>
                        </div>
                    </div>

                </div>

                <!-- BOTTOM SECTION: FORM & MEDIA UPLOAD -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-20">
                    
                    <!-- Left: Form Input Fasilitas Baru -->
                    <div class="lg:col-span-2 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm flex flex-col h-full">
                        <div class="mb-8">
                            <h3 class="text-[22px] font-bold text-brand-textDark mb-1">Input Fasilitas Baru</h3>
                            <p class="text-[13px] text-gray-500">Lengkapi data untuk publikasi di halaman pengunjung</p>
                        </div>

                        <form class="space-y-6 flex-1 flex flex-col">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Nama Fasilitas -->
                                <div>
                                    <label class="block text-[12px] font-bold text-gray-700 mb-2">Nama Fasilitas</label>
                                    <input type="text" placeholder="Contoh: Kolam Arus Anak" 
                                           class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow placeholder-gray-400">
                                </div>
                                <!-- Kategori Dropdown -->
                                <div>
                                    <label class="block text-[12px] font-bold text-gray-700 mb-2">Kategori</label>
                                    <div class="relative">
                                        <select class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 pl-4 pr-10 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow appearance-none cursor-pointer">
                                            <option value="utama">Utama</option>
                                            <option value="pendukung">Pendukung</option>
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-4 flex items-center pointer-events-none text-gray-500">
                                            <i class="fa-solid fa-chevron-down text-[12px]"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Deskripsi Fasilitas -->
                            <div class="flex-1 flex flex-col">
                                <label class="block text-[12px] font-bold text-gray-700 mb-2">Deskripsi Fasilitas</label>
                                <textarea placeholder="Jelaskan keunggulan dan detail fasilitas ini..." 
                                          class="w-full flex-1 min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow placeholder-gray-400 resize-none"></textarea>
                            </div>

                            <!-- Form Actions -->
                            <div class="flex justify-end items-center gap-4 pt-4 mt-auto">
                                <button type="button" class="text-[14px] font-bold text-gray-700 hover:text-gray-900 px-4 py-2 transition-colors">
                                    Batal
                                </button>
                                <button type="button" class="bg-brand-orange hover:bg-[#b0623f] text-white font-bold px-8 py-3 rounded-lg transition-colors shadow-sm text-[14px]">
                                    Simpan Fasilitas
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Right: Media Fasilitas Upload Box -->
                    <div class="lg:col-span-1 bg-brand-navy rounded-2xl p-8 shadow-lg flex flex-col">
                        <div class="mb-6">
                            <h3 class="text-[18px] font-bold text-white mb-1">Media Fasilitas</h3>
                            <p class="text-[12px] text-gray-400 leading-relaxed">Unggah foto berkualitas tinggi (min. 1200×800px) untuk hasil terbaik pada website marketing.</p>
                        </div>

                        <!-- Drag and Drop Area -->
                        <div class="flex-1 border-2 border-dashed border-[#4A4A68] rounded-xl flex flex-col items-center justify-center p-8 bg-[#32324A]/50 hover:bg-[#32324A] transition-colors cursor-pointer group mb-6 min-h-[160px]">
                            <div class="w-12 h-12 bg-white/5 rounded-full flex items-center justify-center text-brand-orange mb-3 group-hover:scale-110 transition-transform">
                                <i class="fa-solid fa-cloud-arrow-up text-[20px]"></i>
                            </div>
                            <p class="text-white font-bold text-[13px] mb-1">Klik atau tarik foto ke sini</p>
                            <p class="text-[10px] text-gray-500 font-medium tracking-wide">PNG, JPG, HEIC UP TO 10MB</p>
                        </div>

                        <!-- Tips Editorial Alert Box -->
                        <div class="bg-white/5 border border-white/10 rounded-xl p-4 mt-auto">
                            <div class="flex items-center gap-2 mb-2 text-[#E88D57]">
                                <i class="fa-solid fa-circle-info text-[12px]"></i>
                                <span class="text-[10px] font-bold uppercase tracking-wider">TIPS EDITORIAL</span>
                            </div>
                            <p class="text-[11.5px] text-gray-400 leading-relaxed italic font-light">
                                "Gunakan pencahayaan alami dan sudut pandang lebar untuk memperlihatkan skala fasilitas."
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </main>

</body>
</html>