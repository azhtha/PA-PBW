<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
require 'koneksi.php'; 

// === BARIS AJAIB (Penerjemah Simbol ≤ dan ≥) ===
mysqli_set_charset($koneksi, "utf8mb4");

if (!isset($_GET['id'])) {
    header("Location: kelola_harga.php");
    exit;
}

$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM fasilitas WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    header("Location: kelola_harga.php");
    exit;
}

// --- Menangkap nama kolom asli secara otomatis ---
$cols = [];
foreach(array_keys($data) as $key) {
    if (strpos($key, '4jam') !== false) {
        $cols[] = $key;
    }
}
$col_kurang = $cols[0] ?? 'harga_≤4jam';
$col_lebih = $cols[1] ?? 'harga_≥4jam';

// Deteksi dari nama
$is_gazebo = (strpos(strtolower($data['nama']), 'gazebo') !== false);

if (isset($_POST['simpan'])) {
    try {
        if ($is_gazebo) {
            $harga_kurang = (int) preg_replace('/[^0-9]/', '', $_POST['harga_kurang']);
            $harga_lebih = (int) preg_replace('/[^0-9]/', '', $_POST['harga_lebih']);
            
            // Simpan ke kolom 4jam dan kosongkan kolom harga normal
            $sql = "UPDATE fasilitas SET `$col_kurang` = '$harga_kurang', `$col_lebih` = '$harga_lebih', harga = NULL WHERE id = '$id'";
            $update = mysqli_query($koneksi, $sql);
        } else {
            $harga_normal = (int) preg_replace('/[^0-9]/', '', $_POST['harga_normal']);
            
            // Simpan ke kolom harga normal dan kosongkan kolom 4jam
            $sql = "UPDATE fasilitas SET harga = '$harga_normal', `$col_kurang` = NULL, `$col_lebih` = NULL WHERE id = '$id'";
            $update = mysqli_query($koneksi, $sql);
        }

        if ($update) {
            echo "<script>
                    alert('Harga berhasil diperbarui!');
                    window.location.href = 'kelola_harga.php';
                  </script>";
        } else {
            $error = "Gagal memperbarui data: " . mysqli_error($koneksi);
        }
    } catch (Exception $e) {
        $error = "Kesalahan: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Harga - Admin Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>
<body class="bg-[#FAFAFB] min-h-screen flex items-center justify-center p-6 text-gray-800">

    <div class="flex flex-col lg:flex-row items-start gap-6 lg:gap-8 w-full max-w-[880px]">

        <div class="bg-white rounded-[24px] shadow-[0_10px_40px_-10px_rgba(0,0,0,0.08)] w-full lg:flex-1 overflow-hidden z-10 relative">
            
            <div class="p-8 md:p-10">
                <div class="mb-8">
                    <p class="text-[#C27A5B] text-[10px] font-bold uppercase tracking-widest mb-2">Formulir Pembaruan</p>
                    <h2 class="text-[26px] font-extrabold text-[#1a1a24]">Detail Harga Item</h2>
                </div>

                <?php if(isset($error)) : ?>
                    <div class="bg-red-50 text-red-500 p-3 rounded-lg text-sm mb-5 font-medium border border-red-100">
                        <i class="fa-solid fa-circle-exclamation mr-2"></i> <?= $error; ?>
                    </div>
                <?php endif; ?>

                <form action="" method="POST">
                    
                    <div class="mb-6">
                        <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Nama Item</label>
                        <div class="flex items-center gap-3 bg-[#F4F5F7] rounded-xl px-4 py-3.5 border border-transparent">
                            <i class="fa-solid <?= $is_gazebo ? 'fa-house-chimney-window text-[#4589A9]' : 'fa-ticket text-[#E88D57]' ?> text-[18px]"></i>
                            <input type="text" value="<?= $data['nama']; ?>" readonly class="bg-transparent font-bold text-[#1a1a24] outline-none w-full text-[14px]">
                        </div>
                    </div>

                    <?php if ($is_gazebo) : ?>
                        <div class="mb-5">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga ≤ 4 Jam</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_kurang" value="<?= isset($data[$col_kurang]) && $data[$col_kurang] !== null ? (int)$data[$col_kurang] : ''; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                            <p class="text-gray-400 text-[11px] mt-2 font-medium">Berlaku untuk durasi penggunaan maksimal 4 jam.</p>
                        </div>

                        <div class="mb-8">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga Seharian</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_lebih" value="<?= isset($data[$col_lebih]) && $data[$col_lebih] !== null ? (int)$data[$col_lebih] : ''; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                            <p class="text-gray-400 text-[11px] mt-2 font-medium">Berlaku untuk penggunaan dari jam buka hingga tutup.</p>
                        </div>

                    <?php else : ?>
                        <div class="mb-8">
                            <label class="block text-gray-500 text-[11px] font-bold uppercase tracking-wider mb-2">Harga Normal</label>
                            <div class="flex items-center bg-[#F4F5F7] rounded-xl px-4 py-3.5 focus-within:ring-2 focus-within:ring-[#C27A5B]/30 focus-within:bg-white transition-all border border-transparent focus-within:border-[#C27A5B]">
                                <span class="font-bold text-gray-500 mr-2 text-[15px]">Rp</span>
                                <input type="number" name="harga_normal" value="<?= $data['harga'] !== null ? (int)$data['harga'] : ''; ?>" required class="bg-transparent font-bold text-[#C27A5B] outline-none w-full text-[16px]">
                            </div>
                            <p class="text-gray-400 text-[11px] mt-2 font-medium">Masukan angka tanpa titik (contoh: 25000)</p>
                        </div>
                    <?php endif; ?>

                    <div class="flex items-center gap-3 mt-4">
                        <button type="submit" name="simpan" class="flex-1 bg-[#C27A5B] hover:bg-[#a66549] text-white font-bold text-[14px] py-3.5 rounded-xl transition-colors shadow-[0_4px_12px_-2px_rgba(194,122,91,0.4)]">
                            Simpan Perubahan
                        </button>
                        <a href="kelola_harga.php" class="px-6 py-3.5 rounded-xl bg-white border border-gray-200 text-gray-600 font-bold text-[14px] hover:bg-gray-50 transition-colors text-center">
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <div class="bg-[#5B5B6E] rounded-[20px] p-7 shadow-xl w-full lg:w-[320px] text-white lg:mt-16">
            <div class="flex justify-between items-center mb-5">
                <h3 class="text-[16px] font-bold tracking-wide">Panduan Admin</h3>
                <div class="w-8 h-8 rounded-full border-2 border-[#E88D57] text-[#E88D57] flex items-center justify-center shrink-0">
                    <i class="fa-solid fa-info text-[13px]"></i>
                </div>
            </div>
            
            <p class="text-[#D4D4D8] text-[13px] leading-relaxed mb-6 font-medium">
                Perubahan harga akan langsung diterapkan pada sistem reservasi pengunjung.
            </p>
            
            <div class="bg-[#FFFFFF]/10 rounded-[12px] p-3.5 flex items-center gap-3">
                <i class="fa-solid fa-arrows-rotate text-[#A1A1AA] text-[14px]"></i>
                <span class="text-[12px] text-[#E4E4E7] font-semibold tracking-wide">Sinkronisasi otomatis aktif</span>
            </div>
        </div>

    </div>

</body>
</html>