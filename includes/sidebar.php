<?php
// Deteksi nama file yang sedang dibuka
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="w-[260px] bg-[#2B2B43] h-full flex flex-col shrink-0 relative z-20 shadow-xl">
    <div class="h-[80px] flex items-center px-8 border-b border-white/10 shrink-0">
        <a href="dashboard_admin.php" class="text-xl font-bold text-white leading-tight">
            Taman Salma<br><span class="text-[#E88D57]">Shofa</span>
        </a>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 px-4 space-y-2 no-scrollbar">
        <p class="px-4 text-[10px] font-bold text-gray-500 uppercase tracking-widest mb-3">Menu Utama</p>
        
        <a href="dashboard_admin.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'dashboard_admin.php') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-border-all w-5 text-center <?= ($current_page == 'dashboard_admin.php') ? 'text-[#E88D57]' : '' ?>"></i> Dashboard
        </a>
        
        <a href="status_gazebo.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'status_gazebo.php') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-house-chimney w-5 text-center <?= ($current_page == 'status_gazebo.php') ? 'text-[#E88D57]' : '' ?>"></i> Status Gazebo
        </a>
        
        <a href="kelola_harga.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'kelola_harga.php') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-money-bill-wave w-5 text-center <?= ($current_page == 'kelola_harga.php') ? 'text-[#E88D57]' : '' ?>"></i> Kelola Harga
        </a>

        <a href="kelola_fasilitas.php" class="flex items-center gap-3 px-4 py-3 rounded-xl font-medium text-[13.5px] transition-colors <?= ($current_page == 'kelola_fasilitas.php') ? 'text-white bg-white/10' : 'text-gray-400 hover:text-white hover:bg-white/5' ?>">
            <i class="fa-solid fa-box-open w-5 text-center <?= ($current_page == 'kelola_fasilitas.php') ? 'text-[#E88D57]' : '' ?>"></i> Kelola Fasilitas
        </a>
    </nav>

    <div class="p-6 border-t border-white/10 mt-auto">
        <a href="logout.php" class="flex items-center gap-3 px-4 py-3 rounded-xl text-[#EF4444] hover:bg-[#EF4444]/10 font-bold text-[13.5px] transition-colors">
            <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i> Keluar System
        </a>
    </div>
</aside>