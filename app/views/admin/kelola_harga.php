<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php';

// === BARIS AJAIB (Penerjemah Simbol ≤ dan ≥) ===
mysqli_set_charset($koneksi, "utf8mb4");

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Harga - Admin Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#FAFAFB] flex h-screen overflow-hidden text-gray-800">

    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 overflow-y-auto no-scrollbar">
        <div class="p-8 md:p-12 max-w-[1100px] mx-auto">
            
            <a href="dashboard_admin.php" class="inline-flex items-center gap-2 text-[13px] font-bold text-gray-400 hover:text-[#E88D57] transition-colors mb-8">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard Utama
            </a>

            <div class="flex justify-between items-start mb-10">
                <div>
                    <h1 class="text-[32px] md:text-[36px] font-extrabold text-[#1a1a24] mb-2 tracking-tight">Kelola Harga</h1>
                    <p class="text-gray-500 text-[14.5px] leading-relaxed max-w-[650px]">Atur dan perbarui daftar harga fasilitas dan penyewaan gazebo Taman Salma Shofa.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
                <div class="md:col-span-2 bg-white rounded-[24px] p-8 md:p-10 border border-gray-100 shadow-[0_2px_15px_-3px_rgba(0,0,0,0.03)] flex flex-col justify-center">
                    <p class="text-[#B05C38] text-[11px] font-bold uppercase tracking-[0.1em] mb-3">Update Terakhir</p>
                    <h2 class="text-[28px] font-extrabold text-[#1a1a24] mb-4"><?= date('d F Y'); ?></h2>
                </div>

                <div class="bg-[#E6F3F8] rounded-[24px] p-8 md:p-10 flex flex-col justify-center">
                    <i class="fa-solid fa-tags text-[#4589A9] text-[24px] mb-4"></i>
                    <p class="text-[#153B50] text-[13px] font-bold mb-1">Total Fasilitas</p>
                    <h2 class="text-[48px] font-extrabold text-[#153B50] leading-none">
                        <?php
                            $hitung = mysqli_query($koneksi, "SELECT COUNT(id) as total FROM fasilitas");
                            $total_item = ($hitung) ? mysqli_fetch_assoc($hitung)['total'] : "0";
                            echo sprintf("%02d", $total_item);
                        ?>
                    </h2>
                </div>
            </div>

            <div class="mb-20">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-[5px] h-6 bg-[#9C4B2E] rounded-full"></div>
                    <h3 class="text-[20px] font-extrabold text-[#1a1a24]">Daftar Lengkap Harga</h3>
                </div>

                <div class="hidden md:grid grid-cols-12 gap-4 px-8 py-4 text-[11px] font-extrabold text-gray-400 uppercase tracking-widest mb-2">
                    <div class="col-span-5">Nama Layanan</div>
                    <div class="col-span-2">Kategori</div>
                    <div class="col-span-3">Detail Harga</div>
                    <div class="col-span-2 text-center">Aksi</div>
                </div>

                <div class="bg-white border border-gray-100 rounded-[24px] shadow-sm overflow-hidden">
                    
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM fasilitas ORDER BY nama ASC");
                    
                    if($query && mysqli_num_rows($query) > 0) {
                        while ($row = mysqli_fetch_assoc($query)) : 
                            
                            $nama = $row['nama']; 
                            $nama_lower = strtolower($nama);

                            // KATEGORI UI
                            if (strpos($nama_lower, 'gazebo') !== false) {
                                $kategori = 'Gazebo';
                                $theme = ['bg'=>'bg-[#FEF0E6]', 'text'=>'text-[#E88D57]', 'icon'=>'fa-house-chimney-window'];
                            } elseif (strpos($nama_lower, 'tiket') !== false || strpos($nama_lower, 'renang') !== false) {
                                $kategori = 'Area/Tiket';
                                $theme = ['bg'=>'bg-[#E6F3F8]', 'text'=>'text-[#4589A9]', 'icon'=>'fa-ticket'];
                            } elseif (strpos($nama_lower, 'kantin') !== false || strpos($nama_lower, 'lapangan') !== false) {
                                $kategori = 'Fasilitas';
                                $theme = ['bg'=>'bg-[#EAE6F8]', 'text'=>'text-[#7A5CA8]', 'icon'=>'fa-map-location-dot'];
                            } else {
                                $kategori = 'Umum';
                                $theme = ['bg'=>'bg-[#F4F5F7]', 'text'=>'text-gray-500', 'icon'=>'fa-box-open'];
                            }

                            // --- Menangkap nama kolom asli secara otomatis ---
                            $cols = [];
                            foreach(array_keys($row) as $key) {
                                if (strpos($key, '4jam') !== false) {
                                    $cols[] = $key;
                                }
                            }
                            $col_kurang = $cols[0] ?? 'harga_≤4jam';
                            $col_lebih = $cols[1] ?? 'harga_≥4jam';

                            $harga = $row['harga'];
                            $harga_kurang_4jam = $row[$col_kurang] ?? null; 
                            $harga_lebih_4jam = $row[$col_lebih] ?? null;
                    ?>
                    
                    <div class="flex flex-col md:grid md:grid-cols-12 md:items-center gap-4 px-8 py-5 border-b border-gray-50 hover:bg-[#FAFAFB] transition-colors last:border-0">
                        
                        <div class="col-span-5 flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl <?= $theme['bg'] ?> flex items-center justify-center <?= $theme['text'] ?> shrink-0">
                                <i class="fa-solid <?= $theme['icon'] ?> text-[18px]"></i>
                            </div>
                            <span class="font-extrabold text-[14px] text-[#1a1a24]"><?= $nama; ?></span>
                        </div>
                        
                        <div class="col-span-2 flex items-center">
                            <span class="<?= $theme['bg'] ?> <?= $theme['text'] ?> text-[10px] font-extrabold px-3 py-1.5 rounded-full uppercase tracking-wider">
                                <?= $kategori; ?>
                            </span>
                        </div>
                        
                        <div class="col-span-3 flex flex-col justify-center">
                            <?php 
                            if (strpos($nama_lower, 'gazebo') !== false) : ?>
                                <div class="text-[12px] text-gray-500 font-medium mb-1">
                                    ≤ 4 Jam: <span class="font-extrabold text-[#1a1a24] text-[13px]"><?= ($harga_kurang_4jam !== null) ? 'Rp ' . number_format((float)$harga_kurang_4jam, 0, ',', '.') : '-'; ?></span>
                                </div>
                                <div class="text-[12px] text-gray-500 font-medium">
                                    Seharian: <span class="font-extrabold text-[#1a1a24] text-[13px]"><?= ($harga_lebih_4jam !== null) ? 'Rp ' . number_format((float)$harga_lebih_4jam, 0, ',', '.') : '-'; ?></span>
                                </div>
                            
                            <?php elseif ($harga !== null) : ?>
                                <span class="font-extrabold text-[15px] text-[#1a1a24]">Rp <?= number_format((float)$harga, 0, ',', '.'); ?></span>
                            
                            <?php else : ?>
                                <span class="font-extrabold text-[13px] text-gray-400 italic">Gratis / Belum Diatur</span>
                            <?php endif; ?>
                        </div>
                        
                        <div class="col-span-2 flex items-center justify-center">
                            <a href="edit_harga.php?id=<?= $row['id']; ?>" class="block text-center bg-white border border-gray-200 text-gray-700 hover:text-white hover:bg-[#E88D57] hover:border-[#E88D57] font-bold text-[12px] px-5 py-2.5 rounded-lg transition-all w-[120px]">
                                Ubah Harga
                            </a>
                        </div>

                    </div>
                    <?php 
                        endwhile; 
                    } else {
                        echo '<div class="p-8 text-center text-gray-500 font-medium">Belum ada data di tabel fasilitas.</div>';
                    }
                    ?>

                </div>
            </div>

        </div>
    </main>

</body>
</html>