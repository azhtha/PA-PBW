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
    <title>Manajemen Status Gazebo - Admin Taman Salma Shofa</title>
    
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
                            orange: '#E88D57',      // Primary Orange
                            lightOrange: '#FDF3ED', // Background orange ringan
                            bgLight: '#FAFAFB',     // Main background
                            textDark: '#1A1A24',    // Heading text
                            textMuted: '#6B7280',   // Gray text
                            
                            // Status Colors
                            green: '#10B981',       // Tersedia
                            blue: '#3B82F6',        // Sewa
                            booking: '#E28E66'      // Booking/Orange
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
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight relative z-0">
        
        <!-- SCROLLABLE DASHBOARD CONTENT -->
        <div class="flex-1 overflow-y-auto no-scrollbar p-10 pt-12">
            <div class="max-w-[1400px] mx-auto">
                
                <!-- HEADER & LEGEND -->
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8">
                    <div>
                        <h1 class="text-[32px] font-bold text-brand-textDark mb-1">Manajemen Status Gazebo</h1>
                        <p class="text-gray-500 text-[15px]">Pantau dan kelola ketersediaan 21 gazebo secara real-time.</p>
                    </div>
                    
                    <!-- Legend -->
                    <div class="flex items-center gap-5">
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full border-2 border-brand-green"></div>
                            <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Tersedia</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full border-2 border-brand-blue"></div>
                            <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Sewa Di Tempat</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <div class="w-3 h-3 rounded-full border-2 border-brand-booking"></div>
                            <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Booking</span>
                        </div>
                    </div>
                </div>

                <!-- CONTROLS: FILTERS & DATE PICKER -->
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-10">
                    
                    <!-- Segmented Control Tabs -->
                    <div class="bg-[#EAECEE] p-1.5 rounded-xl flex items-center overflow-x-auto no-scrollbar">
                        <button class="bg-[#5C5E75] text-white px-6 py-2.5 rounded-lg text-[13.5px] font-semibold shadow-sm shrink-0">
                            Semua
                        </button>
                        <button class="text-gray-500 hover:text-gray-800 px-6 py-2.5 rounded-lg text-[13.5px] font-semibold transition-colors shrink-0">
                            Tersedia
                        </button>
                        <button class="text-gray-500 hover:text-gray-800 px-6 py-2.5 rounded-lg text-[13.5px] font-semibold transition-colors shrink-0">
                            Sewa < 4 Jam
                        </button>
                        <button class="text-gray-500 hover:text-gray-800 px-6 py-2.5 rounded-lg text-[13.5px] font-semibold transition-colors shrink-0">
                            Booking Seharian
                        </button>
                    </div>

                    <!-- Date Picker Display -->
                    <div class="bg-white border border-gray-200 rounded-xl px-5 py-3 flex items-center justify-between gap-6 shadow-sm cursor-pointer hover:border-gray-300 transition-colors min-w-[250px]">
                        <div class="flex items-center gap-3">
                            <i class="fa-regular fa-calendar text-brand-orange text-lg"></i>
                            <div class="flex flex-col">
                                <span class="text-[9px] font-bold text-gray-400 uppercase tracking-wider mb-0.5">Pilih Tanggal</span>
                                <span class="text-[13.5px] font-bold text-gray-800 leading-none">Selasa, 24 Oktober 2023</span>
                            </div>
                        </div>
                        <i class="fa-solid fa-chevron-down text-gray-400 text-xs"></i>
                    </div>

                </div>

                <!-- GAZEBO CARDS GRID -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    
                    <!-- Card 01: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 01</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '01')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 02: Booking -->
                    <div class="bg-[#FFF8F5] rounded-[18px] p-6 border border-[#FDEAE2] shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 02</h3>
                            </div>
                            <span class="inline-block bg-[#FDEAE2] text-brand-booking text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate">Arisan Ibu Maya</p>
                            <p class="text-brand-booking text-[11px] font-bold uppercase tracking-wider">Seharian</p>
                        </div>
                        <button type="button" onclick="openModal('lihat', '02')" class="w-full bg-brand-booking text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-[#cf7b56] transition-colors shadow-sm">
                            Lihat Booking
                        </button>
                    </div>

                    <!-- Card 03: Sewa Di Tempat -->
                    <div class="bg-[#F5F8FF] rounded-[18px] p-6 border border-[#E0E7FF] shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 03</h3>
                            </div>
                            <span class="inline-block bg-[#E0E7FF] text-brand-blue text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate">Keluarga Wijaya</p>
                            <p class="text-brand-blue text-[13px] font-semibold tracking-wide">10:00 - 14:00</p>
                        </div>
                        <button type="button" onclick="openModal('lihat', '03')" class="w-full bg-brand-blue text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-blue-600 transition-colors shadow-sm">
                            Selesaikan
                        </button>
                    </div>

                    <!-- Card 04: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 04</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '04')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 05: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 05</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '05')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 06: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 06</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">12 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '06')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 07: Sewa Di Tempat -->
                    <div class="bg-[#F5F8FF] rounded-[18px] p-6 border border-[#E0E7FF] shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 07</h3>
                            </div>
                            <span class="inline-block bg-[#E0E7FF] text-brand-blue text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate">Keluarga Wijaya</p>
                            <p class="text-brand-blue text-[13px] font-semibold tracking-wide">10:00 - 14:00</p>
                        </div>
                        <button type="button" onclick="openModal('lihat', '07')" class="w-full bg-brand-blue text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-blue-600 transition-colors shadow-sm">
                            Selesaikan
                        </button>
                    </div>

                    <!-- Card 08: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 08</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '08')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 09: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 09</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '09')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                    <!-- Card 10: Booking -->
                    <div class="bg-[#FFF8F5] rounded-[18px] p-6 border border-[#FDEAE2] shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 10</h3>
                            </div>
                            <span class="inline-block bg-[#FDEAE2] text-brand-booking text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate">Arisan Ibu Maya</p>
                            <p class="text-brand-booking text-[11px] font-bold uppercase tracking-wider">Seharian</p>
                        </div>
                        <button type="button" onclick="openModal('lihat', '10')" class="w-full bg-brand-booking text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-[#cf7b56] transition-colors shadow-sm">
                            Lihat Booking
                        </button>
                    </div>

                    <!-- Card 11: Sewa Di Tempat -->
                    <div class="bg-[#F5F8FF] rounded-[18px] p-6 border border-[#E0E7FF] shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 11</h3>
                            </div>
                            <span class="inline-block bg-[#E0E7FF] text-brand-blue text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-textDark font-bold text-[14px] mb-0.5 truncate">Keluarga Wijaya</p>
                            <p class="text-brand-blue text-[13px] font-semibold tracking-wide">10:00 - 14:00</p>
                        </div>
                        <button type="button" onclick="openModal('lihat', '11')" class="w-full bg-brand-blue text-white font-semibold text-[13px] py-2.5 rounded-lg hover:bg-blue-600 transition-colors shadow-sm">
                            Selesaikan
                        </button>
                    </div>

                    <!-- Card 12: Tersedia -->
                    <div class="bg-white rounded-[18px] p-6 border border-gray-100 shadow-sm flex flex-col justify-between h-[230px] hover:shadow-md transition-shadow">
                        <div>
                            <div class="flex justify-between items-start mb-2">
                                <h3 class="text-[18px] font-bold text-brand-textDark">Gazebo - 12</h3>
                            </div>
                            <span class="inline-block bg-[#F4F5F7] text-gray-400 text-[9px] font-bold px-2 py-1 rounded uppercase tracking-wider">9 Orang</span>
                        </div>
                        <div class="mt-4 mb-4">
                            <p class="text-brand-green font-bold text-[14px] mb-0.5">Tersedia</p>
                            <p class="text-gray-400 text-[12px]">Siap digunakan</p>
                        </div>
                        <button type="button" onclick="openModal('atur', '12')" class="w-full bg-[#F9FAFB] border border-gray-100 text-gray-400 font-semibold text-[13px] py-2.5 rounded-lg hover:bg-gray-100 hover:text-gray-600 transition-colors">
                            Atur Status
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </main>

    <!-- OFFCANVAS MODAL OVERLAY -->
    <!-- Z-index dinaikkan menjadi 9998 agar dipastikan menutupi semua konten -->
    <div id="modalOverlay" class="fixed inset-0 bg-black/40 z-[9998] hidden opacity-0 transition-opacity duration-300 backdrop-blur-sm" onclick="closeModal()"></div>

    <!-- OFFCANVAS MODAL PANEL -->
    <!-- Z-index dinaikkan menjadi 9999 -->
    <div id="modalPanel" class="fixed inset-y-0 right-0 w-full max-w-[420px] bg-white z-[9999] transform translate-x-full transition-transform duration-300 shadow-[0_0_40px_rgba(0,0,0,0.2)] flex flex-col">
        
        <!-- Modal Header -->
        <div class="px-7 py-6 flex justify-between items-start">
            <div>
                <h2 id="modalTitle" class="text-[22px] font-bold text-brand-textDark leading-tight">Detail Gazebo 01</h2>
                <p class="text-[13px] text-gray-500 mt-1">Kelola status dan informasi penyewa</p>
            </div>
            <button onclick="closeModal()" class="text-gray-500 hover:text-gray-900 transition-colors bg-gray-100 hover:bg-gray-200 w-8 h-8 rounded-full flex items-center justify-center">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div>

        <!-- Modal Body (Scrollable) -->
        <div class="flex-1 overflow-y-auto px-7 py-2 space-y-6">
            
            <!-- Status Banner -->
            <div id="modalStatusBanner" class="bg-[#EEF2FF] rounded-[14px] p-4 flex items-center gap-4 transition-colors">
                <div id="modalStatusIconContainer" class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#4F46E5] shadow-sm shrink-0">
                    <i class="fa-solid fa-border-all text-[20px]"></i>
                </div>
                <div>
                    <p id="modalStatusLabel" class="text-[10px] font-bold text-[#4F46E5] uppercase tracking-wider mb-0.5">Status Saat Ini</p>
                    <p id="modalStatusText" class="text-[16px] font-bold text-[#3730A3] leading-none">Sewa di tempat</p>
                </div>
            </div>

            <!-- Input Fields -->
            <div class="space-y-5">
                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Penyewa / Booking</label>
                    <input type="text" id="inputNama" class="w-full border border-gray-200 rounded-xl p-3.5 text-[14px] text-brand-textDark font-medium outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all placeholder-gray-300" placeholder="Masukkan nama penyewa">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nomor Telepon</label>
                    <input type="text" id="inputTelepon" class="w-full border border-gray-200 rounded-xl p-3.5 text-[14px] text-brand-textDark font-medium outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange transition-all placeholder-gray-300" placeholder="Masukkan nomor telepon">
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-3">Tipe Layanan</label>
                    <div class="space-y-2.5">
                        <label class="radio-container flex items-center gap-3 border border-brand-orange bg-[#FFF8F5] rounded-xl p-3.5 cursor-pointer transition-all">
                            <input type="radio" name="tipe_layanan" value="sewa_singkat" class="accent-brand-orange w-4 h-4" checked>
                            <span class="text-[14px] font-medium text-brand-textDark">Sewa < 4 Jam</span>
                        </label>
                        <label class="radio-container flex items-center gap-3 border border-gray-200 rounded-xl p-3.5 cursor-pointer transition-all hover:bg-gray-50">
                            <input type="radio" name="tipe_layanan" value="sewa_lama" class="accent-brand-orange w-4 h-4">
                            <span class="text-[14px] font-medium text-gray-600">Sewa > 4 Jam / Seharian</span>
                        </label>
                        <label class="radio-container flex items-center gap-3 border border-gray-200 rounded-xl p-3.5 cursor-pointer transition-all hover:bg-gray-50">
                            <input type="radio" name="tipe_layanan" value="booking" class="accent-brand-orange w-4 h-4">
                            <span class="text-[14px] font-medium text-gray-600">Booking Dimuka</span>
                        </label>
                    </div>
                </div>

                <div>
                    <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Jam Sewa</label>
                    <div class="flex items-center gap-3">
                        <input type="text" id="inputJamMulai" class="flex-1 border border-gray-200 rounded-xl p-3 text-[14px] text-center font-medium text-brand-textDark outline-none focus:border-brand-orange transition-all placeholder-gray-300" placeholder="00:00 WITA">
                        <span class="text-[13px] text-gray-400 font-medium">ke</span>
                        <input type="text" id="inputJamSelesai" class="flex-1 border border-gray-200 rounded-xl p-3 text-[14px] text-center font-medium text-brand-textDark outline-none focus:border-brand-orange transition-all placeholder-gray-300" placeholder="00:00 WITA">
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Footer Actions -->
        <div class="p-7 border-t border-gray-100 bg-white pt-5">
            <button class="w-full bg-[#E39873] hover:bg-[#d48761] text-white font-bold text-[14px] py-3.5 rounded-xl transition-colors shadow-sm flex items-center justify-center gap-2">
                <i class="fa-regular fa-floppy-disk"></i> Simpan Perubahan
            </button>
            <button type="button" class="w-full mt-3 text-[#DC2626] hover:bg-red-50 font-bold text-[14px] py-3.5 rounded-xl transition-colors flex items-center justify-center gap-2 border border-transparent hover:border-red-100">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Kosongkan Status (Check-out)
            </button>
        </div>

    </div>

    <!-- Script to handle Modal Logic -->
    <script>
        // Fungsi Dideklarasikan di Level Global agar bisa dipanggil onClick secara langsung
        function openModal(mode, gazeboNum) {
            const overlay = document.getElementById('modalOverlay');
            const panel = document.getElementById('modalPanel');
            const radios = document.querySelectorAll('input[name="tipe_layanan"]');
            
            // Elements Reference
            const title = document.getElementById('modalTitle');
            const inputNama = document.getElementById('inputNama');
            const inputTelepon = document.getElementById('inputTelepon');
            const inputJamMulai = document.getElementById('inputJamMulai');
            const inputJamSelesai = document.getElementById('inputJamSelesai');
            
            const statusBanner = document.getElementById('modalStatusBanner');
            const statusIconContainer = document.getElementById('modalStatusIconContainer');
            const statusLabel = document.getElementById('modalStatusLabel');
            const statusText = document.getElementById('modalStatusText');

            // Set Title
            if (title) title.textContent = `Detail Gazebo ${gazeboNum}`;

            if (mode === 'atur') {
                // Keadaan "Atur Status" -> Kosong / Tersedia
                if (inputNama) inputNama.value = '';
                if (inputTelepon) inputTelepon.value = '';
                if (inputJamMulai) inputJamMulai.value = '';
                if (inputJamSelesai) inputJamSelesai.value = '';
                
                // Clear selection slightly 
                if (radios.length > 0) {
                    radios[0].checked = true; 
                    radios[0].dispatchEvent(new Event('change')); // trigger style update
                }
                
                // Status Banner -> Hijau (Tersedia)
                if (statusBanner) statusBanner.className = 'bg-[#ECFDF5] rounded-[14px] p-4 flex items-center gap-4 transition-colors';
                if (statusIconContainer) statusIconContainer.className = 'w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#059669] shadow-sm shrink-0';
                if (statusLabel) statusLabel.className = 'text-[10px] font-bold text-[#059669] uppercase tracking-wider mb-0.5';
                if (statusText) {
                    statusText.className = 'text-[16px] font-bold text-[#047857] leading-none';
                    statusText.textContent = 'Tersedia';
                }

            } else if (mode === 'lihat') {
                // Keadaan "Lihat Booking" atau "Selesaikan" -> Terisi seperti gambar referensi
                if (inputNama) inputNama.value = 'Budi Santoso';
                if (inputTelepon) inputTelepon.value = '081234567890';
                if (inputJamMulai) inputJamMulai.value = '09:00 WITA';
                if (inputJamSelesai) inputJamSelesai.value = '13:00 WITA';
                
                if (radios.length > 0) {
                    radios[0].checked = true; // Select "Sewa < 4 Jam"
                    radios[0].dispatchEvent(new Event('change')); // trigger style update
                }

                // Status Banner -> Ungu Muda (Sewa di tempat)
                if (statusBanner) statusBanner.className = 'bg-[#EEF2FF] rounded-[14px] p-4 flex items-center gap-4 transition-colors';
                if (statusIconContainer) statusIconContainer.className = 'w-12 h-12 bg-white rounded-xl flex items-center justify-center text-[#4F46E5] shadow-sm shrink-0';
                if (statusLabel) statusLabel.className = 'text-[10px] font-bold text-[#4F46E5] uppercase tracking-wider mb-0.5';
                if (statusText) {
                    statusText.className = 'text-[16px] font-bold text-[#3730A3] leading-none';
                    statusText.textContent = 'Sewa di tempat';
                }
            }

            // Animate Modal Open
            if (overlay && panel) {
                overlay.classList.remove('hidden');
                
                // Force browser reflow to allow transition to work
                void overlay.offsetWidth; 
                
                overlay.classList.add('opacity-100');
                overlay.classList.remove('opacity-0');
                
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
            }
        }

        function closeModal() {
            const overlay = document.getElementById('modalOverlay');
            const panel = document.getElementById('modalPanel');

            if (overlay && panel) {
                // Animate Modal Close
                overlay.classList.remove('opacity-100');
                overlay.classList.add('opacity-0');
                
                panel.classList.remove('translate-x-0');
                panel.classList.add('translate-x-full');

                // Hide element after transition completes
                setTimeout(() => {
                    overlay.classList.add('hidden');
                }, 300);
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Setup Radio Button interactive styling
            const radioContainers = document.querySelectorAll('.radio-container');
            const radios = document.querySelectorAll('input[name="tipe_layanan"]');

            if (radios.length > 0) {
                radios.forEach((radio, index) => {
                    radio.addEventListener('change', () => {
                        // Reset all styles
                        radioContainers.forEach(container => {
                            container.classList.remove('border-brand-orange', 'bg-[#FFF8F5]');
                            container.classList.add('border-gray-200');
                            container.querySelector('span').classList.remove('text-brand-textDark');
                            container.querySelector('span').classList.add('text-gray-600');
                        });
                        
                        // Apply active style
                        if(radio.checked) {
                            const activeContainer = radioContainers[index];
                            activeContainer.classList.add('border-brand-orange', 'bg-[#FFF8F5]');
                            activeContainer.classList.remove('border-gray-200');
                            activeContainer.querySelector('span').classList.add('text-brand-textDark');
                            activeContainer.querySelector('span').classList.remove('text-gray-600');
                        }
                    });
                });
            }
        });
    </script>
</body>
</html>