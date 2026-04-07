<?php
session_start();
// if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
require 'koneksi.php'; 

date_default_timezone_set('Asia/Makassar');
$hari_inggris = date('l');
$bulan_angka = date('n');

$daftar_hari = [
    'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
    'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'
];
$daftar_bulan = [
    1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
    5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
    9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
];

$hari_ini = $daftar_hari[$hari_inggris];
$tanggal_ini = date('d');
$bulan_ini = $daftar_bulan[$bulan_angka];
$tahun_ini = date('Y');
$tanggal_realtime = "$hari_ini, $tanggal_ini $bulan_ini $tahun_ini";

$hari_ini_db = date('Y-m-d'); 

// --- LOGIKA PENCARIAN BOOKING ---
$keyword = "";
if (isset($_GET['search_booking'])) {
    $keyword = mysqli_real_escape_string($koneksi, $_GET['search_booking']);
}

$query_total = mysqli_query($koneksi, "SELECT COUNT(id) as total FROM gazebos");
$total_gazebo = mysqli_fetch_assoc($query_total)['total'];

$query_terisi = mysqli_query($koneksi, "SELECT COUNT(id) as terisi FROM bookings WHERE tanggal_kunjungan = '$hari_ini_db' AND status = 'terisi'");
$gazebo_terisi = mysqli_fetch_assoc($query_terisi)['terisi'];

$gazebo_tersedia = $total_gazebo - $gazebo_terisi;
$persentase_okupansi = ($total_gazebo > 0) ? round(($gazebo_terisi / $total_gazebo) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        brand: { navy: '#2B2B43', orange: '#e88d57', lightOrange: '#FDF3ED', bgLight: '#FAFAFB', textDark: '#1A1A24', textMuted: '#6B7280' }
                    }
                }
            }
        }
    </script>
    <style>
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
        .tips-bg { background-color: #4A4A68; background-image: radial-gradient(circle at 80% 120%, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%); position: relative; overflow: hidden; }
        .tips-bg::after { content: ''; position: absolute; right: -20px; bottom: -30px; width: 150px; height: 150px; background-image: url('data:image/svg+xml;utf8,<svg viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M50 0C50 0 65 35 100 50C100 50 65 65 50 100C50 100 35 65 0 50C0 50 35 35 50 0Z" fill="rgba(255,255,255,0.05)"/></svg>'); background-size: cover; pointer-events: none; }
    </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight">
        
        <header class="h-[80px] bg-white border-b border-gray-100 flex items-center justify-between px-8 shrink-0">
            <form action="" method="GET" class="relative w-[250px] md:w-[300px]">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i class="fa-solid fa-magnifying-glass text-sm"></i>
                </div>
                <input type="text" name="search_booking" value="<?= htmlspecialchars($keyword) ?>" placeholder="Cari nama tamu..." class="w-full bg-[#F4F5F7] text-[13px] rounded-lg py-2.5 pl-10 pr-4 outline-none focus:ring-1 focus:ring-brand-orange transition-shadow">
            </form>

            <div class="flex items-center gap-6">
                <div class="hidden lg:flex items-center gap-3">
                    <a href="index.php" target="_blank" class="text-[12px] font-bold text-gray-600 bg-gray-100 hover:bg-gray-200 px-4 py-2.5 rounded-lg transition-colors"><i class="fa-solid fa-globe"></i> Lihat Website</a>
                    <button onclick="syncData(this)" id="btnSync" class="flex items-center gap-2 text-[12px] font-bold text-white bg-brand-orange hover:bg-[#d97c45] px-4 py-2.5 rounded-lg transition-all shadow-sm"><i class="fa-solid fa-arrows-rotate" id="syncIcon"></i> <span id="syncText">Sinkronkan</span></button>
                </div>

                <div class="h-8 w-px bg-gray-200"></div>

                <div class="flex items-center gap-4 text-gray-500">
                    <div class="relative group">
                        <button class="hover:text-brand-orange transition-colors relative"><i class="fa-regular fa-bell text-[18px]"></i><span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full border border-white"></span></button>
                        <div class="absolute right-0 mt-3 w-[280px] bg-white border border-gray-100 rounded-xl shadow-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50 p-2">
                            <div class="px-3 py-2 border-b border-gray-100 flex justify-between items-center mb-1"><span class="text-[12px] font-bold">Notifikasi</span><span class="bg-red-100 text-red-500 text-[9px] font-bold px-2 py-0.5 rounded-full">Baru</span></div>
                            <div class="p-2 flex gap-3 hover:bg-gray-50 rounded-lg cursor-pointer">
                                <div class="w-8 h-8 rounded-full bg-red-100 flex items-center justify-center text-red-500 shrink-0"><i class="fa-regular fa-clock text-xs"></i></div>
                                <div><p class="text-[11px] font-bold">Cek Status Gazebo!</p><p class="text-[10px] text-gray-500">Beberapa durasi sewa segera berakhir.</p></div>
                            </div>
                        </div>
                    </div>
                    <a href="pengaturan_akun.php" class="hover:text-brand-orange transition-colors"><i class="fa-solid fa-gear text-[18px]"></i></a>
                </div>

                <div class="h-8 w-px bg-gray-200"></div>

                <a href="pengaturan_akun.php" class="flex items-center gap-3 group">
                    <div class="text-right hidden sm:block">
                        <p class="text-[14px] font-bold text-brand-textDark group-hover:text-brand-orange transition-colors">Admin Salma</p>
                        <p class="text-[10px] font-semibold text-gray-400 uppercase tracking-wider">SUPER ADMIN</p>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin+Salma&background=2B2B43&color=fff&rounded=true" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                </a>
            </div>
        </header>

        <div class="flex-1 overflow-y-auto no-scrollbar p-8">
            <div class="max-w-[1200px] mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-[28px] font-bold text-brand-textDark mb-1">Selamat Pagi, Salma!</h1>
                        <p class="text-brand-textMuted text-[14px]">Berikut ringkasan operasional Taman Salma Shofa hari ini.</p>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-lg px-4 py-2.5 flex items-center gap-3 shadow-sm text-[13.5px] font-bold text-gray-700">
                        <i class="fa-regular fa-calendar text-brand-orange"></i>
                        <span class="border-r border-gray-200 pr-3"><?= $tanggal_realtime; ?></span>
                        <span id="jamDigital" class="text-brand-orange pl-1 w-[70px] text-center tracking-wider">00:00:00</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-l-brand-navy flex justify-between items-start">
                        <div><p class="text-[11px] font-bold text-gray-400 uppercase mb-1">Total Gazebo</p><h2 class="text-[42px] font-bold text-brand-textDark leading-none mb-2"><?= sprintf("%02d", $total_gazebo) ?></h2><p class="text-[12px] text-gray-400">Kapasitas Maksimal Unit</p></div>
                        <div class="w-12 h-12 rounded-lg bg-[#F4F5F7] flex items-center justify-center text-brand-navy"><i class="fa-solid fa-house-chimney-window text-[22px]"></i></div>
                    </div>
                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-l-[#C2511D] flex justify-between items-start">
                        <div><p class="text-[11px] font-bold text-gray-400 uppercase mb-1">Gazebo Terisi</p><h2 class="text-[42px] font-bold text-[#C2511D] leading-none mb-2"><?= sprintf("%02d", $gazebo_terisi) ?></h2><p class="text-[12px] text-gray-400"><?= $persentase_okupansi ?>% Okupansi Hari Ini</p></div>
                        <div class="w-12 h-12 rounded-lg bg-brand-lightOrange flex items-center justify-center text-[#C2511D]"><i class="fa-regular fa-calendar-check text-[22px]"></i></div>
                    </div>
                    <div class="bg-[#DDEAE9] rounded-xl p-6 shadow-sm border-l-4 border-l-[#3B82F6] flex justify-between items-start">
                        <div><p class="text-[11px] font-bold text-gray-600 uppercase mb-1">Siap Booking</p><h2 class="text-[42px] font-bold text-[#1E3A8A] leading-none mb-2"><?= sprintf("%02d", $gazebo_tersedia) ?></h2><p class="text-[12px] text-gray-600">Tersedia untuk walk-in</p></div>
                        <div class="w-12 h-12 rounded-lg bg-white/50 flex items-center justify-center text-[#1E3A8A]"><i class="fa-solid fa-clipboard-check text-[22px]"></i></div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <div class="lg:col-span-2">
                        <div class="flex justify-between items-center mb-5">
                            <h3 class="text-[18px] font-bold text-brand-textDark">
                                <?= !empty($keyword) ? "Hasil Pencarian: '$keyword'" : "Jadwal Gazebo Hari Ini" ?>
                            </h3>
                            <a href="status_gazebo.php" class="text-[13px] font-bold text-[#9C4B2E] hover:underline">Lihat Semua Jadwal</a>
                        </div>
                        <div class="bg-white border border-gray-100 rounded-[14px] shadow-sm overflow-hidden">
                            <div class="grid grid-cols-12 gap-4 px-6 py-4 bg-[#F8F9FA] border-b border-gray-100 text-[11px] font-bold text-gray-400 uppercase">
                                <div class="col-span-2">Gazebo</div><div class="col-span-4">Nama Tamu</div><div class="col-span-3">Waktu</div><div class="col-span-3 text-center">Status</div>
                            </div>
                            <div class="divide-y divide-gray-100">
                                <?php 
                                // Query jadwal dengan filter pencarian
                                $sql_jadwal = "SELECT b.*, g.nomor_gazebo FROM bookings b 
                                               JOIN gazebos g ON b.gazebo_id = g.id 
                                               WHERE b.tanggal_kunjungan = '$hari_ini_db' AND b.status = 'terisi'";
                                
                                if (!empty($keyword)) {
                                    $sql_jadwal .= " AND b.nama_pemesan LIKE '%$keyword%'";
                                }

                                $sql_jadwal .= " ORDER BY b.jam_mulai ASC, CAST(g.nomor_gazebo AS UNSIGNED) ASC LIMIT 5";
                                $query_jadwal = mysqli_query($koneksi, $sql_jadwal);

                                if(mysqli_num_rows($query_jadwal) > 0):
                                    while($row = mysqli_fetch_assoc($query_jadwal)): 
                                        $jam_teks = "Seharian";
                                        if (!empty($row['jam_mulai']) && !empty($row['jam_selesai'])) {
                                            $jam_teks = date('H:i', strtotime($row['jam_mulai'])) . " - " . date('H:i', strtotime($row['jam_selesai']));
                                        }
                                        $status_label = ($row['durasi'] == 'sewa_singkat') ? "SEDANG DIGUNAKAN" : "BOOKING AKTIF";
                                        $label_class = ($row['durasi'] == 'sewa_singkat') ? "bg-[#FEE2E2] text-[#991B1B]" : "bg-brand-lightOrange text-[#C2511D]";
                                ?>
                                <div class="grid grid-cols-12 gap-4 px-6 py-4 items-center hover:bg-gray-50 transition-colors">
                                    <div class="col-span-2 font-bold text-[14px] text-brand-textDark">G-<?= $row['nomor_gazebo'] ?></div>
                                    <div class="col-span-4"><p class="font-bold text-[13.5px] truncate"><?= htmlspecialchars($row['nama_pemesan']) ?></p><p class="text-[11.5px] text-gray-400"><i class="fa-brands fa-whatsapp text-green-500 mr-1"></i><?= htmlspecialchars($row['no_whatsapp']) ?></p></div>
                                    <div class="col-span-3 flex items-center gap-2 text-[13px] text-gray-600"><i class="fa-regular fa-clock text-gray-400"></i><?= $jam_teks ?></div>
                                    <div class="col-span-3 text-center">
                                        <span class="<?= $label_class ?> text-[9.5px] font-bold px-3 py-1.5 rounded-full whitespace-nowrap block text-center"><?= $status_label ?></span>
                                    </div>
                                </div>
                                <?php endwhile; else: ?>
                                <div class="py-10 text-center text-gray-400">
                                    <i class="fa-solid fa-magnifying-glass text-3xl mb-2 opacity-50 block"></i>
                                    <p class="text-[13px]">
                                        <?= !empty($keyword) ? "Booking untuk '$keyword' tidak ditemukan." : "Belum ada jadwal hari ini." ?>
                                    </p>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1 space-y-4">
                        <h3 class="text-[18px] font-bold text-brand-textDark mb-1">Akses Cepat</h3>
                        
                        <a href="kelola_harga.php" class="bg-white border border-gray-100 rounded-xl p-4 flex items-center gap-4 hover:border-gray-300 transition-all block">
                            <div class="w-11 h-11 bg-[#FDF5F2] rounded-lg flex items-center justify-center text-[#B05C38] shrink-0"><i class="fa-solid fa-money-bill-wave"></i></div>
                            <div><h4 class="font-bold text-[13.5px]">Kelola Harga</h4><p class="text-[10px] text-gray-400">Atur tarif & paket gazebo</p></div>
                        </a>

                        <a href="kelola_fasilitas.php" class="bg-white border border-gray-100 rounded-xl p-4 flex items-center gap-4 hover:border-gray-300 transition-all block">
                            <div class="w-11 h-11 bg-[#F4F5F7] rounded-lg flex items-center justify-center text-gray-500 shrink-0"><i class="fa-solid fa-box-open"></i></div>
                            <div><h4 class="font-bold text-[13.5px]">Update Fasilitas</h4><p class="text-[10px] text-gray-400">Cek alat & menu tersedia</p></div>
                        </a>

                        <a href="status_gazebo.php" class="bg-white border border-gray-100 rounded-xl p-4 flex items-center gap-4 hover:border-gray-300 transition-all block">
                            <div class="w-11 h-11 bg-[#F4F5F7] rounded-lg flex items-center justify-center text-gray-500 shrink-0"><i class="fa-solid fa-map-location-dot"></i></div>
                            <div><h4 class="font-bold text-[13.5px]">Cek Status Gazebo</h4><p class="text-[10px] text-gray-400">Lihat denah & ketersediaan</p></div>
                        </a>

                        <div class="tips-bg rounded-xl p-5 shadow-sm mt-4">
                            <p class="text-[#E88D57] text-[10px] font-bold uppercase mb-2">Tips Hari Ini</p>
                            <h4 class="text-white text-[16px] font-bold leading-tight mb-2">Optimalkan Weekend</h4>
                            <p class="text-[#D4D4D8] text-[11.5px] leading-relaxed mb-4">Pastikan stok paket makan keluarga sudah terupdate sebelum jam ramai.</p>
                            <span class="inline-flex items-center gap-2 text-white text-[12px] font-bold hover:text-brand-orange transition-colors cursor-pointer">Baca Panduan <i class="fa-solid fa-arrow-right"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <script>
        function jalankanJam() {
            const waktu = new Date();
            const jam = String(waktu.getHours()).padStart(2, '0');
            const menit = String(waktu.getMinutes()).padStart(2, '0');
            const detik = String(waktu.getSeconds()).padStart(2, '0');
            document.getElementById('jamDigital').innerText = `${jam}:${menit}:${detik}`;
        }
        setInterval(jalankanJam, 1000);
        jalankanJam();

        function syncData(btn) {
            const icon = document.getElementById('syncIcon');
            const text = document.getElementById('syncText');
            if(btn.disabled) return;
            btn.disabled = true;
            icon.classList.add('fa-spin');
            text.textContent = 'Sinkronisasi...';
            setTimeout(() => {
                icon.classList.remove('fa-spin');
                icon.classList.replace('fa-arrows-rotate', 'fa-check');
                text.textContent = 'Selesai!';
                btn.classList.replace('bg-brand-orange', 'bg-emerald-500');
                setTimeout(() => {
                    icon.classList.replace('fa-check', 'fa-arrows-rotate');
                    text.textContent = 'Sinkronkan';
                    btn.classList.replace('bg-emerald-500', 'bg-brand-orange');
                    btn.disabled = false;
                }, 2000);
            }, 1500);
        }
    </script>
</body>
</html>