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
    <title>Dashboard Admin - Taman Salma Shofa</title>
    
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
                            orange: '#e88d57',      // Primary Orange
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
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;  /* Firefox */
        }
        
        /* Dekorasi background untuk card tips operasional */
        .tips-bg {
            background-color: #4A4A68;
            background-image: radial-gradient(circle at 80% 120%, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%);
            overflow: hidden;
            position: relative;
        }
        .tips-bg::after {
            content: '';
            position: absolute;
            right: -20px;
            bottom: -30px;
            width: 150px;
            height: 150px;
            background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M50 0C50 0 65 35 100 50C100 50 65 65 50 100C50 100 35 65 0 50C0 50 35 35 50 0Z" fill="rgba(255,255,255,0.05)"/></svg>');
            background-size: cover;
            pointer-events: none;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight">
        
        <!-- TOP NAVBAR -->
        <header class="h-[80px] bg-white border-b border-gray-100 flex items-center justify-between px-8 shrink-0">
            <!-- Search Bar -->
            <div class="relative w-[300px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </div>
                <input type="text" placeholder="Cari booking atau tamu..." 
                       class="w-full bg-[#F4F5F7] text-[13px] text-gray-700 rounded-lg py-2.5 pl-10 pr-4 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow placeholder-gray-400">
            </div>

            <!-- Right Area (Icons & Profile) -->
            <div class="flex items-center gap-6">
                <!-- Action Icons -->
                <div class="flex items-center gap-4 text-gray-500">
                    <button class="hover:text-brand-orange transition-colors relative">
                        <i class="fa-regular fa-bell text-[18px]"></i>
                        <!-- Dot notification indicator -->
                        <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
                    </button>
                    <button class="hover:text-brand-orange transition-colors">
                        <i class="fa-solid fa-gear text-[18px]"></i>
                    </button>
                </div>

                <!-- Divider -->
                <div class="h-8 w-px bg-gray-200"></div>

                <!-- Profile Info -->
                <div class="flex items-center gap-3 cursor-pointer">
                    <div class="text-right">
                        <p class="text-[14px] font-bold text-brand-textDark leading-tight">Admin Salma</p>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">SUPER ADMIN</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Salma&background=2B2B43&color=fff&rounded=true" alt="Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                </div>
            </div>
        </header>

        <!-- SCROLLABLE DASHBOARD CONTENT -->
        <div class="flex-1 overflow-y-auto no-scrollbar p-8">
            <div class="max-w-[1200px] mx-auto">
                
                <!-- Page Header & Date -->
                <div class="flex justify-between items-end mb-8">
                    <div>
                        <h1 class="text-[28px] font-bold text-brand-textDark mb-1">Selamat Pagi, Salma!</h1>
                        <p class="text-brand-textMuted text-[14px]">Berikut ringkasan operasional Taman Salma Shofa hari ini.</p>
                    </div>
                    <!-- Date Picker Display -->
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 flex items-center gap-3 shadow-sm text-[13.5px] font-bold text-gray-700 cursor-pointer hover:border-brand-orange transition-colors">
                        <i class="fa-regular fa-calendar text-brand-orange"></i>
                        Senin, 23 Oktober 2023
                    </div>
                </div>

                <!-- SUMMARY CARDS (3 Columns) -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    
                    <!-- Card 1: Total Gazebo -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 border-l-4 border-l-brand-navy flex justify-between items-start">
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 tracking-wider uppercase mb-1">Total Gazebo</p>
                            <h2 class="text-[42px] font-bold text-brand-textDark leading-none mb-2">21</h2>
                            <p class="text-[12px] text-gray-400">Kapasitas Maksimal Unit</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-[#F4F5F7] flex items-center justify-center text-brand-navy">
                            <i class="fa-solid fa-house-chimney-window text-[22px]"></i>
                        </div>
                    </div>

                    <!-- Card 2: Gazebo Terisi -->
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 border-l-4 border-l-[#C2511D] flex justify-between items-start">
                        <div>
                            <p class="text-[11px] font-bold text-gray-400 tracking-wider uppercase mb-1">Gazebo Terisi</p>
                            <h2 class="text-[42px] font-bold text-[#C2511D] leading-none mb-2">08</h2>
                            <p class="text-[12px] text-gray-400">75% Okupansi Hari Ini</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-brand-lightOrange flex items-center justify-center text-[#C2511D]">
                            <i class="fa-regular fa-calendar-check text-[22px]"></i>
                        </div>
                    </div>

                    <!-- Card 3: Siap Booking -->
                    <div class="bg-[#DDEAE9] rounded-xl p-6 shadow-sm border border-[#DDEAE9] border-l-4 border-l-[#3B82F6] flex justify-between items-start">
                        <div>
                            <p class="text-[11px] font-bold text-gray-600 tracking-wider uppercase mb-1">Siap Booking</p>
                            <h2 class="text-[42px] font-bold text-[#1E3A8A] leading-none mb-2">13</h2>
                            <p class="text-[12px] text-gray-600">Tersedia untuk walk-in</p>
                        </div>
                        <div class="w-12 h-12 rounded-lg bg-white/50 flex items-center justify-center text-[#1E3A8A]">
                            <i class="fa-solid fa-clipboard-check text-[22px]"></i>
                        </div>
                    </div>

                </div>

                <!-- BOTTOM SECTION (Grid 2:1) -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- LEFT COL: Jadwal Gazebo Hari Ini -->
                    <div class="lg:col-span-2">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-[18px] font-bold text-brand-textDark">Jadwal Gazebo Hari Ini</h3>
                            <a href="#" class="text-[13px] font-bold text-[#9C4B2E] hover:underline">Lihat Semua Jadwal</a>
                        </div>
                        
                        <!-- Table/List Area -->
                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm overflow-hidden">
                            <!-- Table Headers -->
                            <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-[#F8F9FA] border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase tracking-wider">
                                <div class="col-span-2">Gazebo</div>
                                <div class="col-span-4">Nama Tamu</div>
                                <div class="col-span-3">Waktu</div>
                                <div class="col-span-3">Status</div>
                            </div>
                            
                            <!-- Rows Container -->
                            <div class="divide-y divide-gray-100">
                                
                                <!-- Row 1 -->
                                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors group">
                                    <div class="col-span-2 font-bold text-[14px] text-brand-textDark">A-01</div>
                                    <div class="col-span-4">
                                        <p class="font-bold text-[13.5px] text-brand-textDark">Bpk. Ahmad Subarjo</p>
                                        <p class="text-[11.5px] text-gray-400 mt-0.5">Rombongan Keluarga (12 orang)</p>
                                    </div>
                                    <div class="col-span-3 flex items-center gap-2 text-[13px] font-medium text-gray-600">
                                        <i class="fa-regular fa-clock text-gray-400"></i> 09:00 - 12:00
                                    </div>
                                    <div class="col-span-3 flex items-center justify-between">
                                        <span class="bg-[#FEE2E2] text-[#991B1B] text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Sedang Digunakan</span>
                                        <button class="text-gray-400 hover:text-gray-600 p-2 opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </div>
                                </div>

                                <!-- Row 2 -->
                                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors group">
                                    <div class="col-span-2 font-bold text-[14px] text-brand-textDark">B-04</div>
                                    <div class="col-span-4">
                                        <p class="font-bold text-[13.5px] text-brand-textDark">Ibu Siti Nurhaliza</p>
                                        <p class="text-[11.5px] text-gray-400 mt-0.5">Arisan (8 orang)</p>
                                    </div>
                                    <div class="col-span-3 flex items-center gap-2 text-[13px] font-medium text-gray-600">
                                        <i class="fa-regular fa-clock text-gray-400"></i> 10:00 - 15:00
                                    </div>
                                    <div class="col-span-3 flex items-center justify-between">
                                        <span class="bg-brand-lightOrange text-[#C2511D] text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Booking Aktif</span>
                                        <button class="text-gray-400 hover:text-gray-600 p-2 opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </div>
                                </div>

                                <!-- Row 3 -->
                                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors group">
                                    <div class="col-span-2 font-bold text-[14px] text-brand-textDark">C-12</div>
                                    <div class="col-span-4">
                                        <p class="font-bold text-[13.5px] text-brand-textDark">Sdr. Rizky Ramadhan</p>
                                        <p class="text-[11.5px] text-gray-400 mt-0.5">Pertemuan Bisnis (4 orang)</p>
                                    </div>
                                    <div class="col-span-3 flex items-center gap-2 text-[13px] font-medium text-gray-600">
                                        <i class="fa-regular fa-clock text-gray-400"></i> 13:30 - 16:00
                                    </div>
                                    <div class="col-span-3 flex items-center justify-between">
                                        <span class="bg-[#E0F2FE] text-[#0369A1] text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Akan Datang</span>
                                        <button class="text-gray-400 hover:text-gray-600 p-2 opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </div>
                                </div>

                                <!-- Row 4 -->
                                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors group">
                                    <div class="col-span-2 font-bold text-[14px] text-brand-textDark">A-05</div>
                                    <div class="col-span-4">
                                        <p class="font-bold text-[13.5px] text-brand-textDark">Bpk. Hendra Wijaya</p>
                                        <p class="text-[11.5px] text-gray-400 mt-0.5">Makan Siang (6 orang)</p>
                                    </div>
                                    <div class="col-span-3 flex items-center gap-2 text-[13px] font-medium text-gray-600">
                                        <i class="fa-regular fa-clock text-gray-400"></i> 14:00 - 18:00
                                    </div>
                                    <div class="col-span-3 flex items-center justify-between">
                                        <span class="bg-[#E0F2FE] text-[#0369A1] text-[10px] font-bold px-3 py-1.5 rounded-full uppercase tracking-wide">Akan Datang</span>
                                        <button class="text-gray-400 hover:text-gray-600 p-2 opacity-0 group-hover:opacity-100 transition-opacity"><i class="fa-solid fa-ellipsis-vertical"></i></button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- RIGHT COL: Akses Cepat & Tips -->
                    <div class="lg:col-span-1 space-y-5">
                        <h3 class="text-[18px] font-bold text-brand-textDark mb-1">Akses Cepat</h3>
                        
                        <!-- Quick Access Cards -->
                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm p-4 flex items-center gap-4 cursor-pointer hover:border-gray-300 transition-colors group">
                            <div class="w-12 h-12 bg-[#FDF5F2] rounded-lg flex items-center justify-center text-[#B05C38] shrink-0 group-hover:bg-[#f6e4dc] transition-colors">
                                <i class="fa-solid fa-money-bill-wave text-[18px]"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[14px] text-brand-textDark">Kelola Harga</h4>
                                <p class="text-[11px] text-gray-400 mt-0.5">Sesuaikan tarif gazebo & paket</p>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm p-4 flex items-center gap-4 cursor-pointer hover:border-gray-300 transition-colors group">
                            <div class="w-12 h-12 bg-[#F4F5F7] rounded-lg flex items-center justify-center text-gray-500 shrink-0 group-hover:bg-[#e8ebf0] transition-colors">
                                <i class="fa-solid fa-box-open text-[18px]"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[14px] text-brand-textDark">Update Fasilitas</h4>
                                <p class="text-[11px] text-gray-400 mt-0.5">Kelola ketersediaan alat & menu</p>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm p-4 flex items-center gap-4 cursor-pointer hover:border-gray-300 transition-colors group">
                            <div class="w-12 h-12 bg-[#F4F5F7] rounded-lg flex items-center justify-center text-gray-500 shrink-0 group-hover:bg-[#e8ebf0] transition-colors">
                                <i class="fa-solid fa-map-location-dot text-[18px]"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-[14px] text-brand-textDark">Cek Status Gazebo</h4>
                                <p class="text-[11px] text-gray-400 mt-0.5">Lihat peta denah interaktif</p>
                            </div>
                        </div>

                        <!-- Tips Operasional Card -->
                        <div class="tips-bg rounded-[14px] p-6 shadow-md mt-6">
                            <p class="text-[#E88D57] text-[10px] font-bold uppercase tracking-wider mb-2">Tips Operasional</p>
                            <h4 class="text-white text-[18px] font-bold leading-snug mb-3">Optimalkan Weekend Booking</h4>
                            <p class="text-[#D4D4D8] text-[12px] leading-relaxed mb-6">Pastikan stok paket makan keluarga sudah terupdate sebelum Jumat sore.</p>
                            <a href="#" class="inline-flex items-center gap-2 text-white text-[13px] font-bold hover:text-brand-orange transition-colors z-10 relative">
                                Baca Panduan <i class="fa-solid fa-arrow-right text-[12px]"></i>
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </main>

</body>
</html>