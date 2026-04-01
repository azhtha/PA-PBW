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
    <title>Kelola Harga - Admin Taman Salma Shofa</title>
    
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
                            
                            // Specific Custom Colors from Image
                            brownAccent: '#A05A3A', // Update terakhir text
                            blueCard: '#DDF0F9',    // Total Item card bg
                            blueIcon: '#5B9EBE',    // Total Item icon
                            blueText: '#1A3B4D',    // Total Item text
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
        
        /* Hilangkan spinner panah atas/bawah pada input type number */
        input[type="number"]::-webkit-inner-spin-button,
        input[type="number"]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type="number"] {
            -moz-appearance: textfield;
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <!-- MAIN CONTENT AREA -->
    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight relative">
        
        <div class="flex-1 overflow-y-auto no-scrollbar p-8 lg:p-12">
            <div class="max-w-[1100px] mx-auto">
                
                <!-- HEADER TITLE & INFO -->
                <div class="flex justify-between items-start mb-8">
                    <div>
                        <h1 class="text-[34px] font-bold text-brand-textDark mb-2 leading-tight">Kelola Harga</h1>
                        <p class="text-gray-500 text-[15px] max-w-2xl leading-relaxed">Atur dan perbarui daftar harga tiket masuk, paket camping, dan penyewaan gazebo Taman Salma Shofa.</p>
                    </div>
                    <button class="w-10 h-10 rounded-full border-[2px] border-brand-orange text-brand-orange flex items-center justify-center hover:bg-brand-orange/10 transition-colors shrink-0 mt-2">
                        <i class="fa-solid fa-info text-[18px]"></i>
                    </button>
                </div>

                <!-- SUMMARY CARDS -->
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-12">
                    
                    <!-- Update Terakhir Card -->
                    <div class="lg:col-span-2 bg-white rounded-[20px] p-7 md:p-9 border border-gray-100 shadow-sm flex flex-col justify-center">
                        <p class="text-[11px] font-bold text-brand-brownAccent uppercase tracking-wider mb-2">Update Terakhir</p>
                        <h2 class="text-[26px] md:text-[28px] font-bold text-brand-textDark mb-4">12 Oktober 2023, 14:30</h2>
                        <a href="#" class="text-[#BC5228] font-bold text-[14px] flex items-center gap-2 w-max hover:underline transition-all">
                            Lihat Riwayat Perubahan <i class="fa-solid fa-arrow-right text-[12px]"></i>
                        </a>
                    </div>

                    <!-- Total Item Aktif Card -->
                    <div class="bg-brand-blueCard rounded-[20px] p-7 md:p-9 flex flex-col justify-center relative overflow-hidden">
                        <!-- Decorative Shape -->
                        <div class="absolute right-0 top-0 w-32 h-full bg-white/20 rounded-l-[100px] blur-2xl"></div>
                        
                        <div class="relative z-10">
                            <div class="text-brand-blueIcon text-[26px] mb-3">
                                <i class="fa-solid fa-tags transform -rotate-90"></i>
                            </div>
                            <p class="text-[15px] font-bold text-brand-blueText mb-0">Total Item Aktif</p>
                            <h2 class="text-[46px] font-bold text-brand-blueText leading-none">08</h2>
                        </div>
                    </div>

                </div>

                <!-- DAFTAR LENGKAP HARGA -->
                <div>
                    <!-- Section Title -->
                    <div class="flex items-center gap-3 mb-6 px-1">
                        <div class="w-[5px] h-6 bg-[#9A5034] rounded-full"></div>
                        <h2 class="text-[20px] font-bold text-brand-textDark">Daftar Lengkap Harga</h2>
                    </div>

                    <!-- Table Header -->
                    <div class="hidden md:grid grid-cols-12 gap-4 px-6 py-3 mb-2 text-[11px] font-bold text-gray-400 uppercase tracking-[0.1em]">
                        <div class="col-span-4">Nama Layanan</div>
                        <div class="col-span-3">Kategori</div>
                        <div class="col-span-3">Detail Harga</div>
                        <div class="col-span-2 text-center">Aksi</div>
                    </div>

                    <!-- List Container -->
                    <div class="space-y-3 pb-20">
                        
                        <!-- ITEM 1: Tiket Masuk Umum -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-ticket-simple text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Tiket Masuk Umum</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#E1F1FB] text-[#347898] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Tiket</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="font-bold text-[18px] text-brand-textDark">Rp 25.000</span>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Tiket Masuk Umum', '25.000', '', 'fa-ticket-simple')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 2: Bundling Tiket -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-layer-group text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Bundling Tiket (Taman + Beranda)</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#E1F1FB] text-[#347898] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Bundling</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="font-bold text-[18px] text-brand-textDark">Rp 50.000</span>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Bundling Tiket (Taman + Beranda)', '50.000', '', 'fa-layer-group')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 3: Paket Camping 01 -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-tent text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Paket Camping 01</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#F1E8FD] text-[#7A4B9F] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Camping</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="font-bold text-[18px] text-brand-textDark">Rp 60.000</span>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Paket Camping 01', '60.000', '', 'fa-tent')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 4: Paket Camping 02 -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-tent text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Paket Camping 02</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#F1E8FD] text-[#7A4B9F] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Camping</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="font-bold text-[18px] text-brand-textDark">Rp 100.000</span>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Paket Camping 02', '100.000', '', 'fa-tent')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 5: Paket Camping 03 -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-tent text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Paket Camping 03</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#F1E8FD] text-[#7A4B9F] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Camping</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="font-bold text-[18px] text-brand-textDark">Rp 150.000</span>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Paket Camping 03', '150.000', '', 'fa-tent')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 6: Gazebo 1-6 -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-house-chimney text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Gazebo 1-6</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#FBECE6] text-[#BB5728] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Gazebo</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex flex-col gap-1 justify-center">
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">&lt; 4 Jam:</span>
                                    <span class="font-bold text-brand-textDark">Rp 100.000</span>
                                </div>
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">Seharian:</span>
                                    <span class="font-bold text-brand-textDark">Rp 200.000</span>
                                </div>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Gazebo 1-6', '100.000', '200.000', 'fa-house-chimney')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 7: Gazebo 7-20 -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-house-chimney text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Gazebo 7-20</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#FBECE6] text-[#BB5728] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Gazebo</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex flex-col gap-1 justify-center">
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">&lt; 4 Jam:</span>
                                    <span class="font-bold text-brand-textDark">Rp 75.000</span>
                                </div>
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">Seharian:</span>
                                    <span class="font-bold text-brand-textDark">Rp 150.000</span>
                                </div>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Gazebo 7-20', '75.000', '150.000', 'fa-house-chimney')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                        <!-- ITEM 8: Gazebo 21 (VIP) -->
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 md:gap-4 px-5 py-4 md:py-3.5 bg-white border border-gray-100 rounded-[16px] items-center shadow-sm hover:shadow-md transition-shadow">
                            <div class="col-span-1 md:col-span-4 flex items-center gap-4">
                                <div class="w-11 h-11 bg-[#FDECE7] text-[#CD6D39] rounded-xl flex items-center justify-center shrink-0">
                                    <i class="fa-solid fa-house-chimney text-[18px]"></i>
                                </div>
                                <span class="font-bold text-[15px] text-brand-textDark">Gazebo 21 (VIP)</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex items-center">
                                <span class="bg-[#FBECE6] text-[#BB5728] px-3 py-1 rounded-full text-[9px] font-bold tracking-wider uppercase">Gazebo</span>
                            </div>
                            <div class="col-span-1 md:col-span-3 flex flex-col gap-1 justify-center">
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">&lt; 4 Jam:</span>
                                    <span class="font-bold text-brand-textDark">Rp 300.000</span>
                                </div>
                                <div class="flex items-center gap-2 text-[12.5px]">
                                    <span class="text-gray-500 w-[55px]">Seharian:</span>
                                    <span class="font-bold text-brand-textDark">Rp 500.000</span>
                                </div>
                            </div>
                            <div class="col-span-1 md:col-span-2 flex items-center md:justify-center mt-2 md:mt-0">
                                <button onclick="openModalHarga('Gazebo 21 (VIP)', '300.000', '500.000', 'fa-house-chimney')" class="w-full md:w-auto px-5 py-2 border border-gray-200 rounded-lg text-[13px] font-semibold text-gray-700 hover:border-gray-300 hover:bg-gray-50 transition-colors shadow-sm">Ubah Harga</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </main>

    <!-- MODAL CONTAINER (Overlay + Modal Window + Side Guide) -->
    <div id="modalHargaContainer" class="fixed inset-0 z-[9999] hidden items-center justify-center px-4">
        
        <!-- Dark Overlay Backdrop -->
        <div id="modalHargaOverlay" class="absolute inset-0 bg-black/60 opacity-0 transition-opacity duration-300 backdrop-blur-sm" onclick="closeModalHarga()"></div>
        
        <!-- Flex Wrapper to align Modal Box and Guide Card side by side -->
        <div id="modalHargaPanel" class="relative z-10 flex items-stretch gap-6 transform scale-95 opacity-0 transition-all duration-300 max-w-[800px] w-full justify-center">
            
            <!-- 1. Main Modal Box -->
            <div class="bg-white rounded-[24px] p-8 md:p-10 w-full max-w-[460px] shadow-2xl">
                <!-- Header -->
                <div class="mb-8">
                    <p class="text-[#C2511D] text-[10px] font-bold tracking-widest uppercase mb-1.5">Formulir Pembaruan</p>
                    <h2 class="text-[26px] font-bold text-brand-textDark leading-tight">Detail Harga Item</h2>
                </div>

                <!-- Form Fields -->
                <div class="space-y-6">
                    
                    <!-- Nama Item -->
                    <div>
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Nama Item</label>
                        <div class="bg-[#F9FAFB] rounded-xl p-4 flex items-center gap-3">
                            <i id="modalIconItem" class="fa-solid fa-house-chimney text-gray-400 text-[16px]"></i>
                            <span id="modalNamaItem" class="font-bold text-[15px] text-brand-textDark">Gazebo 1-6</span>
                        </div>
                    </div>

                    <!-- Harga 1 (< 4 Jam / Umum) -->
                    <div>
                        <label id="labelHarga1" class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Harga < 4 Jam</label>
                        <div class="bg-[#F9FAFB] border border-gray-100 rounded-xl p-3.5 flex items-center gap-3">
                            <span class="font-bold text-gray-500 text-[16px]">Rp</span>
                            <input type="text" id="modalHarga1" class="bg-transparent w-full text-[17px] font-bold text-[#CD6D39] outline-none" value="100.000">
                        </div>
                        <p id="helperHarga1" class="text-[10px] text-gray-400 mt-2 font-medium">Berlaku untuk durasi penggunaan maksimal 4 jam.</p>
                    </div>

                    <!-- Harga 2 (Seharian) - Disembunyikan jika tidak relevan -->
                    <div id="groupHarga2">
                        <label class="block text-[11px] font-bold text-gray-500 uppercase tracking-wider mb-2">Harga Seharian</label>
                        <div class="bg-[#F9FAFB] border border-gray-100 rounded-xl p-3.5 flex items-center gap-3">
                            <span class="font-bold text-gray-500 text-[16px]">Rp</span>
                            <input type="text" id="modalHarga2" class="bg-transparent w-full text-[17px] font-bold text-[#CD6D39] outline-none" value="200.000">
                        </div>
                        <p class="text-[10px] text-gray-400 mt-2 font-medium">Berlaku untuk penggunaan dari jam buka hingga tutup.</p>
                    </div>

                </div>

                <!-- Action Buttons -->
                <div class="flex gap-3 mt-10">
                    <button class="flex-1 bg-brand-orange hover:bg-[#d47b46] text-white font-bold py-3.5 rounded-xl shadow-sm transition-colors text-[14px]">
                        Simpan Perubahan
                    </button>
                    <button onclick="closeModalHarga()" class="px-8 py-3.5 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition-colors text-[14px]">
                        Batal
                    </button>
                </div>
            </div>

            <!-- 2. Panduan Admin Card (Hidden on mobile, visible on lg screens) -->
            <div class="hidden lg:flex flex-col bg-[#6B687C] w-[280px] rounded-[24px] p-8 shadow-2xl relative">
                <div class="flex justify-between items-start mb-4">
                    <h3 class="text-white font-bold text-[18px]">Panduan Admin</h3>
                    <div class="w-7 h-7 rounded-full border-[1.5px] border-brand-orange text-brand-orange flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-info text-[12px]"></i>
                    </div>
                </div>
                <p class="text-[#D4D4D8] text-[13px] leading-[1.8] mb-8">
                    Perubahan harga akan langsung diterapkan pada sistem reservasi pengunjung. Pastikan angka yang dimasukkan sudah sesuai dengan kebijakan terbaru pengelola Taman Salma Shofa.
                </p>
                <div class="mt-auto bg-white/10 rounded-xl p-4 flex items-center justify-center gap-3 text-white/90 text-[12px] font-semibold border border-white/5">
                    <i class="fa-solid fa-arrows-rotate text-[14px]"></i>
                    Sinkronisasi otomatis ke website
                </div>
            </div>

        </div>
    </div>

    <!-- Script to handle Modal Logic -->
    <script>
        // Modal global logic
        window.openModalHarga = function(namaItem, harga1, harga2, iconClass) {
            const container = document.getElementById('modalHargaContainer');
            const overlay = document.getElementById('modalHargaOverlay');
            const panel = document.getElementById('modalHargaPanel');
            
            // Populate Data
            document.getElementById('modalNamaItem').innerText = namaItem;
            document.getElementById('modalHarga1').value = harga1;
            
            // Set Icon
            const iconEl = document.getElementById('modalIconItem');
            iconEl.className = `fa-solid ${iconClass} text-gray-400 text-[16px]`;
            
            // Handle if there is a second price (like Gazebo) or just one (like Tiket/Camping)
            const groupHarga2 = document.getElementById('groupHarga2');
            const labelHarga1 = document.getElementById('labelHarga1');
            const helperHarga1 = document.getElementById('helperHarga1');

            if (!harga2) {
                groupHarga2.style.display = 'none';
                labelHarga1.innerText = 'HARGA ITEM';
                helperHarga1.innerText = 'Harga yang berlaku untuk satu kali transaksi.';
            } else {
                groupHarga2.style.display = 'block';
                document.getElementById('modalHarga2').value = harga2;
                labelHarga1.innerText = 'HARGA < 4 JAM';
                helperHarga1.innerText = 'Berlaku untuk durasi penggunaan maksimal 4 jam.';
            }
            
            // Show & Animate Modal
            container.classList.remove('hidden');
            container.classList.add('flex');
            
            // Small delay to ensure display block is registered before applying transition opacity
            setTimeout(() => {
                overlay.classList.remove('opacity-0');
                overlay.classList.add('opacity-100');
                
                panel.classList.remove('scale-95', 'opacity-0');
                panel.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        window.closeModalHarga = function() {
            const container = document.getElementById('modalHargaContainer');
            const overlay = document.getElementById('modalHargaOverlay');
            const panel = document.getElementById('modalHargaPanel');
            
            // Reverse Animation
            overlay.classList.remove('opacity-100');
            overlay.classList.add('opacity-0');
            
            panel.classList.remove('scale-100', 'opacity-100');
            panel.classList.add('scale-95', 'opacity-0');
            
            // Hide after animation finishes (300ms matches Tailwind duration-300)
            setTimeout(() => {
                container.classList.add('hidden');
                container.classList.remove('flex');
            }, 300);
        }
    </script>

</body>
</html>