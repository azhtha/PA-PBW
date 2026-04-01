<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan Gazebo - Taman Salma Shofa</title>
    
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

    <!-- HEADER TITLE -->
    <div class="max-w-7xl mx-auto px-6 pt-12 pb-6">
        <h1 class="text-[28px] font-bold text-[#1a1a24] mb-2">Ketersediaan Gazebo</h1>
        <p class="text-brand-greyDark text-[13px]">Pilih gazebo yang tersedia sesuai dengan kebutuhan kunjungan Anda.</p>
    </div>

    <!-- MAIN CONTENT LAYOUT (2 Columns) -->
    <main class="max-w-7xl mx-auto px-6 pb-16 flex flex-col lg:flex-row gap-8 items-start">
        
        <!-- LEFT COLUMN: Controls & Cart (Sidebar) -->
        <aside class="w-full lg:w-[320px] shrink-0 flex flex-col gap-6">
            
            <!-- Card 1: Waktu Kunjungan -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                <div class="flex items-center gap-2 mb-5 font-bold text-[14px] text-gray-800">
                    <i class="fa-regular fa-calendar text-brand-orange text-base"></i>
                    Waktu Kunjungan
                </div>
                
                <!-- Tanggal Input -->
                <div class="mb-5">
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Pilih Tanggal</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <i class="fa-regular fa-calendar-days text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" value="24 October 2023" class="w-full bg-white border border-gray-200 text-gray-700 text-[13px] rounded-lg py-2.5 pl-10 pr-3 outline-none focus:border-brand-orange focus:ring-1 focus:ring-brand-orange shadow-sm cursor-pointer" readonly>
                    </div>
                </div>

                <!-- Durasi Sewa Toggle -->
                <div>
                    <label class="block text-[10px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Durasi Sewa</label>
                    <div class="bg-[#F1F3F5] p-1.5 rounded-xl flex items-center text-[12px] font-medium">
                        <button class="flex-1 py-2 bg-white text-gray-800 rounded-lg shadow-sm">
                            < 4 Jam
                        </button>
                        <button class="flex-1 py-2 text-gray-500 hover:text-gray-700 transition-colors">
                            > 4 Jam
                        </button>
                    </div>
                </div>
            </div>

            <!-- Card 2: Keterangan (Legend) -->
            <div class="bg-white rounded-2xl p-6 border border-gray-200 shadow-sm">
                <h3 class="font-bold text-[14px] text-gray-800 mb-4">Keterangan</h3>
                <div class="grid grid-cols-2 gap-4 text-[13px] text-gray-600 font-medium">
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-[4px] bg-[#EAF7F0] border-[1.5px] border-[#A7E3C4]"></div>
                        Tersedia
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-[4px] bg-[#DADCED] border-[1.5px] border-[#C2C7D6]"></div>
                        Terisi
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-5 h-5 rounded-[4px] bg-brand-orange border-[1.5px] border-brand-orange"></div>
                        Dipilih
                    </div>
                </div>
            </div>

            <!-- Card 3: Gazebo Terpilih (Checkout Box) -->
            <div class="bg-brand-navy rounded-2xl p-6 shadow-lg flex flex-col relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-white/5 rounded-full blur-xl"></div>

                <!-- Header Selected -->
                <div class="mb-6 relative z-10">
                    <p class="text-brand-orange text-[10px] italic mb-1 font-medium">Gazebo Terpilih</p>
                    <div class="flex justify-between items-end">
                        <h2 class="text-white text-[22px] font-bold leading-none">Gazebo #04</h2>
                        <i class="fa-solid fa-campground text-brand-orange text-2xl opacity-80"></i>
                    </div>
                </div>

                <!-- Details List -->
                <div class="border-t border-white/10 pt-4 pb-2 mb-4 space-y-3 text-[12.5px] relative z-10">
                    <div class="flex justify-between items-center text-brand-greyText">
                        <span>Kapasitas</span>
                        <span class="text-white font-medium">12 Orang</span>
                    </div>
                    <div class="flex justify-between items-center text-brand-greyText">
                        <span>Total Harga</span>
                        <span class="text-brand-orange font-bold text-[14px]">Rp 100.000</span>
                    </div>
                </div>

                <!-- Admin Selection -->
                <div class="border-t border-white/10 pt-5 relative z-10">
                    <p class="text-brand-orange text-[10px] font-bold tracking-wider uppercase mb-3">Pilih Admin Untuk Pemesanan</p>
                    
                    <div class="space-y-2 mb-6">
                        <!-- Option 1 (Selected) -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl bg-brand-card border border-brand-orange/40 cursor-pointer">
                            <div class="w-4 h-4 rounded-full border-[4px] border-brand-orange bg-[#2B2B43]"></div>
                            <span class="text-[13px] text-white font-medium">Admin Anggi</span>
                        </label>
                        <!-- Option 2 -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl bg-[#323247] border border-transparent cursor-pointer hover:bg-brand-card transition-colors">
                            <div class="w-4 h-4 rounded-full border-[1.5px] border-gray-500"></div>
                            <span class="text-[13px] text-[#A1A1AA]">Admin Irwan</span>
                        </label>
                        <!-- Option 3 -->
                        <label class="flex items-center gap-3 p-3.5 rounded-xl bg-[#323247] border border-transparent cursor-pointer hover:bg-brand-card transition-colors">
                            <div class="w-4 h-4 rounded-full border-[1.5px] border-gray-500"></div>
                            <span class="text-[13px] text-[#A1A1AA]">Manajer</span>
                        </label>
                    </div>

                    <!-- Checkout Button -->
                    <button class="w-full bg-brand-orange hover:bg-[#d97c45] text-white font-bold text-[13px] py-3.5 rounded-xl transition-all shadow-[0_4px_15px_-3px_rgba(232,141,87,0.4)] flex items-center justify-center gap-2">
                        <i class="fa-regular fa-comment-dots text-base"></i>
                        Pesan Sekarang (WhatsApp)
                    </button>
                </div>
            </div>

        </aside>

        <!-- RIGHT COLUMN: Peta Grid Ketersediaan -->
        <section class="flex-1 w-full bg-white border border-gray-100 shadow-sm rounded-[24px] p-8 lg:p-10">
            
            <!-- Main Grid Container (Vertical Flow) -->
            <div class="flex flex-col gap-10">
                
                <!-- ROW 1 (TOP): Big Zone -->
                <div class="w-full">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-1 h-4 bg-emerald-400 rounded-full"></div>
                        <h3 class="font-bold text-[13px] text-[#1a1a24]">Big Zone (30 Orang)</h3>
                    </div>
                    
                    <!-- Box G21 -->
                    <div class="box-base box-tersedia w-[80px]">
                        <i class="fa-solid fa-users text-emerald-600 mb-1 opacity-70"></i>
                        G21
                    </div>
                </div>

                <!-- ROW 2 (BOTTOM): Family Zone & Standard Zone side-by-side -->
                <div class="flex flex-col xl:flex-row gap-10 xl:gap-14 items-start w-full">
                    
                    <!-- Family Zone (Left Side of Row 2) -->
                    <div class="w-full max-w-[280px]">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-1 h-4 bg-[#e88d57] rounded-full"></div>
                            <h3 class="font-bold text-[13px] text-[#1a1a24]">Family Zone (12 Orang)</h3>
                        </div>
                        
                        <!-- Grid 3x2 -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="box-base box-tersedia">01</div>
                            <div class="box-base box-terisi">02</div>
                            <div class="box-base box-tersedia">03</div>
                            <div class="box-base box-dipilih">04</div>
                            <div class="box-base box-tersedia">05</div>
                            <div class="box-base box-tersedia">06</div>
                        </div>
                    </div>

                    <!-- Standard Zone (Right Side of Row 2) -->
                    <div class="w-full max-w-[280px]">
                        <div class="flex items-center gap-3 mb-5">
                            <div class="w-1 h-4 bg-[#F1C40F] rounded-full"></div>
                            <h3 class="font-bold text-[13px] text-[#1a1a24]">Standard Zone (9 Orang)</h3>
                        </div>
                        
                        <!-- Grid 3x5 -->
                        <div class="grid grid-cols-3 gap-3">
                            <div class="box-base box-tersedia">07</div>
                            <div class="box-base box-tersedia">08</div>
                            <div class="box-base box-tersedia">09</div>
                            
                            <div class="box-base box-terisi">10</div>
                            <div class="box-base box-terisi">11</div>
                            <div class="box-base box-tersedia">12</div>
                            
                            <div class="box-base box-tersedia">13</div>
                            <div class="box-base box-tersedia">14</div>
                            <div class="box-base box-tersedia">15</div>
                            
                            <div class="box-base box-terisi">16</div>
                            <div class="box-base box-tersedia">17</div>
                            <div class="box-base box-tersedia">18</div>
                            
                            <div class="box-base box-tersedia">19</div>
                            <div class="box-base box-tersedia">20</div>
                        </div>
                    </div>

                </div> <!-- End of Row 2 -->

            </div> <!-- End of Main Grid Container -->

        </section>

    </main>

    <!-- BOTTOM SECTION: Informasi Penyewaan Pendopo -->
    <section class="max-w-7xl mx-auto px-6 mt-6 mb-20 text-center">
        <h2 class="text-xl font-bold text-[#1a1a24] mb-2">Informasi Penyewaan Pendopo & Lapangan</h2>
        <p class="text-brand-greyDark text-[13px] mb-10">Untuk informasi lebih lanjut mengenai penyewaan pendopo atau lapangan, silakan hubungi salah satu admin kami melalui WhatsApp:</p>

        <!-- Cards Wrapper -->
        <div class="flex flex-col md:flex-row justify-center items-center gap-6">
            
            <!-- Admin 1 -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex items-center justify-between w-full md:w-[320px] transition-transform hover:-translate-y-1 cursor-pointer">
                <div class="flex items-center gap-4 text-left">
                    <div class="w-11 h-11 rounded-full bg-brand-orangeLight flex items-center justify-center text-brand-orange">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[13px] text-[#1a1a24]">Admin (Anggi)</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">0857 0599 6170</p>
                    </div>
                </div>
                <div class="text-emerald-500 opacity-80 pl-4 border-l border-gray-100">
                    <i class="fa-regular fa-message text-[22px]"></i>
                </div>
            </div>

            <!-- Admin 2 -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex items-center justify-between w-full md:w-[320px] transition-transform hover:-translate-y-1 cursor-pointer">
                <div class="flex items-center gap-4 text-left">
                    <div class="w-11 h-11 rounded-full bg-brand-orangeLight flex items-center justify-center text-brand-orange">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[13px] text-[#1a1a24]">Admin (Irwan)</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">0852 4537 2606</p>
                    </div>
                </div>
                <div class="text-emerald-500 opacity-80 pl-4 border-l border-gray-100">
                    <i class="fa-regular fa-message text-[22px]"></i>
                </div>
            </div>

            <!-- Admin 3 (Manajer) -->
            <div class="bg-white border border-gray-100 shadow-sm rounded-2xl p-5 flex items-center justify-between w-full md:w-[320px] transition-transform hover:-translate-y-1 cursor-pointer">
                <div class="flex items-center gap-4 text-left">
                    <div class="w-11 h-11 rounded-full bg-[#fce9e6] flex items-center justify-center text-[#e57373]">
                        <i class="fa-solid fa-headset"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-[13px] text-[#1a1a24]">Manajer (Abdullah)</h4>
                        <p class="text-[11px] text-gray-500 mt-0.5">08125814350</p>
                    </div>
                </div>
                <div class="text-emerald-500 opacity-80 pl-4 border-l border-gray-100">
                    <i class="fa-regular fa-message text-[22px]"></i>
                </div>
            </div>

        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

</body>
</html>