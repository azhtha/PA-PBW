<?php
session_start();
require 'koneksi.php';

// Ambil ID dari URL
$id = mysqli_real_escape_string($koneksi, $_GET['id']);

// Ambil data fasilitas lama
$query = mysqli_query($koneksi, "SELECT f.*, d.gambar FROM fasilitas f LEFT JOIN dokumentasi d ON f.id = d.fasilitas_id WHERE f.id = '$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) { echo "Data tidak ditemukan!"; exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Fasilitas - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = { theme: { extend: { fontFamily: { sans: ['Poppins', 'sans-serif'] }, colors: { brand: { navy: '#2B2B43', orange: '#E88D57', bgLight: '#FAFAFB', textDark: '#1A1A24' } } } } }
    </script>
</head>
<body class="bg-brand-bgLight font-sans p-8">
    <div class="max-w-[800px] mx-auto">
        <div class="flex items-center gap-4 mb-8">
            <a href="kelola_fasilitas.php" class="w-10 h-10 rounded-full bg-white border border-gray-100 flex items-center justify-center text-gray-400 hover:text-brand-orange transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-brand-textDark">Edit Fasilitas</h1>
                <p class="text-sm text-gray-500">Ubah detail data untuk <?= $data['nama'] ?></p>
            </div>
        </div>

        <div class="bg-white rounded-[32px] p-10 shadow-sm border border-gray-100">
            <form action="proses_fasilitas.php" method="POST" enctype="multipart/form-data" class="space-y-6">
                <input type="hidden" name="id" value="<?= $data['id'] ?>">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[12px] font-bold text-gray-700 mb-2">Nama Fasilitas</label>
                        <input type="text" name="nama" value="<?= $data['nama'] ?>" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange" required>
                    </div>
                    <div>
                        <label class="block text-[12px] font-bold text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange cursor-pointer">
                            <option value="utama" <?= $data['kategori'] == 'utama' ? 'selected' : '' ?>>Fasilitas Utama</option>
                            <option value="pendukung" <?= $data['kategori'] == 'pendukung' ? 'selected' : '' ?>>Fasilitas Pendukung</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" class="w-full min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-sm rounded-xl py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange resize-none"><?= $data['deskripsi'] ?></textarea>
                </div>

                <div class="flex flex-col md:flex-row gap-6 items-start">
                    <div class="flex-1">
                        <label class="block text-[12px] font-bold text-gray-700 mb-2">Ganti Foto (Opsional)</label>
                        <input type="file" name="gambar" class="w-full text-xs text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-orange-50 file:text-brand-orange">
                        <p class="text-[10px] text-gray-400 mt-2 italic">*Kosongkan jika tidak ingin mengubah foto</p>
                    </div>
                    <?php if($data['gambar']): ?>
                    <div class="w-[150px]">
                        <label class="block text-[10px] font-bold text-gray-400 uppercase mb-2">Foto Saat Ini</label>
                        <img src="<?= $data['gambar'] ?>" class="w-full h-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                    </div>
                    <?php endif; ?>
                </div>

                <div class="flex justify-end gap-4 pt-6 border-t border-gray-50">
                    <button type="reset" class="text-sm font-bold text-gray-400 hover:text-gray-600 px-4">Reset</button>
                    <button type="submit" name="update" class="bg-brand-orange hover:bg-[#D97C45] text-white font-bold px-10 py-3 rounded-xl shadow-md transition-all">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>