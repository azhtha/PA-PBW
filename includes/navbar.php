<?php 
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<nav class="bg-[#2B2B43] h-[72px] w-full z-50 shadow-md">
    <div class="max-w-[1440px] h-full mx-auto px-6 md:px-12 flex justify-between items-center">
        
        <a href="index.php" class="flex items-center shrink-0">
            <img src="assets/logo.png" alt="Logo Salma Shofa" class="h-10 w-auto object-contain">
        </a>

        <div class="hidden lg:flex items-center gap-8">
            
            <a href="index.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'index.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Beranda</a>
            
            <a href="informasi.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'informasi.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Informasi Umum</a>
            
            <a href="fasilitas.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'fasilitas.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Fasilitas & Layanan</a>
            
            <a href="gazebo.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'gazebo.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Gazebo</a>
            
            <a href="pricelist.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'pricelist.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">Penawaran</a>
            
            <a href="faq.php" class="text-[14px] font-semibold tracking-wide <?= ($current_page == 'faq.php') ? 'text-[#E88D57]' : 'text-white hover:text-[#E88D57]' ?> transition-colors">FAQ</a>
            
        </div>

        <div class="flex items-center shrink-0">
            <a href="login.php" class="text-white hover:text-[#E88D57] transition-colors">
                <i class="fa-regular fa-circle-user text-[32px]"></i>
            </a>
        </div>

    </div>
</nav>