<?php
session_start();
// if (!isset($_SESSION['login'])) { header("Location: login.php"); exit; }
require 'koneksi.php';

// 1. QUERY FASILITAS UTAMA (MENGGUNAKAN SUBQUERY AGAR AMAN)
$sql_utama = "
    SELECT f.*, 
    (SELECT gambar FROM dokumentasi d WHERE d.fasilitas_id = f.id LIMIT 1) AS gambar 
    FROM fasilitas f 
    WHERE f.kategori = 'utama'
";
$query_utama = mysqli_query($koneksi, $sql_utama);

if (!$query_utama) {
    die("Error Fasilitas Utama: " . mysqli_error($koneksi));
}

// 2. QUERY FASILITAS PENDUKUNG (MENGGUNAKAN SUBQUERY AGAR AMAN)
$sql_pendukung = "
    SELECT f.*, 
    (SELECT gambar FROM dokumentasi d WHERE d.fasilitas_id = f.id LIMIT 1) AS gambar 
    FROM fasilitas f 
    WHERE f.kategori = 'pendukung'
";
$query_pendukung = mysqli_query($koneksi, $sql_pendukung);

if (!$query_pendukung) {
    die("Error Fasilitas Pendukung: " . mysqli_error($koneksi));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: { brand: { navy: '#2B2B43', orange: '#E88D57', bgLight: '#FAFAFB', textDark: '#1A1A24' } }
                }
            }
        }
        
        // FUNGSI PERINGATAN KUAT SAAT MENGHAPUS
        function konfirmasiHapus(namaFasilitas) {
            return confirm("⚠️ PERINGATAN KERAS! ⚠️\n\nAnda akan menghapus fasilitas '" + namaFasilitas + "'.\n\nSemua data gambar dan informasi terkait akan DIHAPUS PERMANEN dari database dan tidak bisa dikembalikan.\n\nApakah Anda benar-benar yakin?");
        }
    </script>
    <style> .no-scrollbar::-webkit-scrollbar { display: none; } </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <?php include 'includes/sidebar.php'; ?>

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight relative">
        <div class="flex-1 overflow-y-auto no-scrollbar p-8 lg:p-10">
            <div class="max-w-[1200px] mx-auto">
                
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-[32px] font-bold text-brand-textDark mb-1 leading-tight">Kelola Fasilitas</h1>
                        <p class="text-gray-500 text-[14px]">Atur aset utama dan amenitas premium Taman Salma Shofa</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <?php while($f = mysqli_fetch_assoc($query_utama)): 
                        $img = !empty($f['gambar']) ? $f['gambar'] : 'https://images.unsplash.com/photo-1576013551627-1422ab1a0f44?w=400&q=80';
                    ?>
                    <div class="bg-white rounded-2xl p-4 border border-gray-100 shadow-sm flex flex-col group">
                        <div class="relative w-full h-[180px] rounded-xl overflow-hidden mb-4 bg-gray-200">
                            <img src="<?= $img ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                            <h3 class="absolute bottom-4 left-4 text-white font-bold text-[18px] tracking-wide"><?= $f['nama'] ?></h3>
                        </div>
                        <div class="flex items-center justify-between mt-auto px-1">
                            <div class="flex items-center gap-2">
                                <a href="edit_fasilitas.php?id=<?= $f['id'] ?>" class="w-8 h-8 rounded border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors"><i class="fa-solid fa-pencil text-[12px]"></i></a>
                                <a href="proses_fasilitas.php?action=delete&id=<?= $f['id'] ?>" 
                                   onclick="return konfirmasiHapus('<?= $f['nama'] ?>')"
                                   class="w-8 h-8 rounded border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors"><i class="fa-regular fa-trash-can text-[12px]"></i></a>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400 italic">Utama</span>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

                <div class="mb-6"><h2 class="text-[22px] font-bold text-brand-textDark leading-tight">Fasilitas Lainnya</h2></div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 mb-14">
                    <?php while($p = mysqli_fetch_assoc($query_pendukung)): 
                        $p_img = !empty($p['gambar']) ? $p['gambar'] : 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=300&q=60';
                    ?>
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative overflow-hidden bg-gray-100">
                            <img src="<?= $p_img ?>" class="absolute inset-0 w-full h-full object-cover">
                            <a href="proses_fasilitas.php?action=delete&id=<?= $p['id'] ?>" 
                               onclick="return konfirmasiHapus('<?= $p['nama'] ?>')"
                               class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </a>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5"><?= $p['nama'] ?></h4>
                            <p class="text-[10px] text-gray-400 line-clamp-1 mb-3"><?= !empty($p['deskripsi']) ? $p['deskripsi'] : 'Layanan pendukung' ?></p>
                            <a href="edit_fasilitas.php?id=<?= $p['id'] ?>" class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-20">
    <div class="lg:col-span-2 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
        <div class="mb-8">
            <h3 class="text-[22px] font-bold text-brand-textDark mb-1">Input Fasilitas Baru</h3>
            <p class="text-[13px] text-gray-500">Lengkapi data untuk publikasi di halaman pengunjung</p>
        </div>
        
        <form action="proses_fasilitas.php" method="POST" enctype="multipart/form-data" id="form-fasilitas" class="space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Nama Fasilitas</label>
                    <input type="text" name="nama" placeholder="Contoh: Kolam Arus Anak" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all" required>
                </div>
                <div>
                    <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Kategori</label>
                    <select name="kategori" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all cursor-pointer">
                        <option value="utama">Utama</option>
                        <option value="pendukung">Pendukung</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Deskripsi Fasilitas</label>
                <textarea name="deskripsi" placeholder="Jelaskan keunggulan dan detail fasilitas ini..." class="w-full min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange resize-none transition-all"></textarea>
            </div>
            
            <div class="flex justify-end items-center gap-6 pt-6">
                <button type="reset" class="text-[14px] font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</button>
                <button type="submit" name="simpan" class="bg-[#C6714A] hover:bg-[#b0623f] text-white font-bold px-10 py-3 rounded-xl transition-all shadow-md active:scale-95">
                    Simpan Fasilitas
                </button>
            </div>
    </div>

    <div class="lg:col-span-1 bg-[#2B2B43] rounded-2xl p-8 shadow-lg flex flex-col h-full relative">
        <div class="mb-6">
            <h3 class="text-[18px] font-bold text-white mb-1">Media Fasilitas</h3>
            <p class="text-[12px] text-gray-400 leading-relaxed">Unggah foto berkualitas tinggi (min. 1200×800px) untuk hasil terbaik pada website marketing.</p>
        </div>

        <label for="input-foto" id="drop-zone" class="flex-1 border-2 border-dashed border-[#4A4A68] rounded-2xl flex flex-col items-center justify-center p-8 bg-[#32324A]/40 hover:bg-[#32324A]/70 hover:border-brand-orange transition-all cursor-pointer group min-h-[220px]">
            <input type="file" name="gambar" id="input-foto" class="hidden" accept="image/*">
            
            <div class="w-14 h-14 bg-white/5 rounded-2xl flex items-center justify-center text-brand-orange mb-4 group-hover:scale-110 transition-transform">
                <i class="fa-solid fa-cloud-arrow-up text-2xl"></i>
            </div>
            
            <p class="text-white font-bold text-[14px] mb-1" id="file-name">Klik atau tarik foto ke sini</p>
            <p class="text-[10px] text-gray-500 font-medium tracking-widest uppercase">PNG, JPG, HEIC UP TO 10MB</p>
        </label>

        <div class="mt-8 bg-white/5 border border-white/10 rounded-2xl p-5">
            <div class="flex items-center gap-3 mb-2 text-brand-orange">
                <i class="fa-solid fa-circle-info text-sm"></i>
                <span class="text-[10px] font-bold uppercase tracking-wider">Tips Editorial</span>
            </div>
            <p class="text-[11px] text-gray-400 leading-relaxed italic">
                "Gunakan pencahayaan alami dan sudut pandang lebar untuk memperlihatkan skala fasilitas."
            </p>
        </div>
        </form> </div>
</div>

            </div>
        </div>
    </main>
    <script>
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('input-foto');
    const fileNameDisplay = document.getElementById('file-name');

    // Menghindari perilaku default browser (membuka file saat drop)
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, e => {
            e.preventDefault();
            e.stopPropagation();
        }, false);
    });

    // Efek visual saat file ditarik di atas kotak
    ['dragenter', 'dragover'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.add('border-brand-orange', 'bg-[#32324A]');
        }, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropZone.addEventListener(eventName, () => {
            dropZone.classList.remove('border-brand-orange', 'bg-[#32324A]');
        }, false);
    });

    // Menangani file yang di-drop
    dropZone.addEventListener('drop', e => {
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            fileInput.files = files; // Masukkan file ke input hidden
            updateFileName(files[0].name);
        }
    });

    // Menangani file yang dipilih lewat klik
    fileInput.addEventListener('change', () => {
        if (fileInput.files.length > 0) {
            updateFileName(fileInput.files[0].name);
        }
    });

    function updateFileName(name) {
        fileNameDisplay.innerText = "File dipilih: " + name;
        fileNameDisplay.classList.add('text-brand-orange');
        dropZone.classList.add('border-brand-orange');
    }
</script>
</body>
</html>