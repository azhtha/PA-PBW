<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Fasilitas - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/vue@3/dist/vue.global.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'], },
                    colors: { brand: { navy: '#2B2B43', orange: '#E88D57', bgLight: '#FAFAFB', textDark: '#1A1A24' } }
                }
            }
        }

        function konfirmasiHapus(namaFasilitas) {
            return confirm("⚠️ PERINGATAN KERAS! ⚠️\n\nAnda akan menghapus fasilitas '" + namaFasilitas + "'.\n\nSemua data gambar dan informasi terkait akan DIHAPUS PERMANEN dari database dan tidak bisa dikembalikan.\n\nApakah Anda benar-benar yakin?");
        }
    </script>
    <style> .no-scrollbar::-webkit-scrollbar { display: none; } </style>
</head>
<body class="font-sans antialiased text-gray-800 bg-brand-bgLight flex h-screen overflow-hidden">

    <!-- Sidebar would be included here -->

    <main class="flex-1 flex flex-col h-full overflow-hidden bg-brand-bgLight relative">
        <div class="flex-1 overflow-y-auto no-scrollbar p-8 lg:p-10">
            <div class="max-w-[1200px] mx-auto">

                <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h1 class="text-[32px] font-bold text-brand-textDark mb-1 leading-tight">Kelola Fasilitas</h1>
                        <p class="text-gray-500 text-[14px]">Atur aset utama dan amenitas premium Taman Salma Shofa</p>
                    </div>
                </div>

                <!-- Fasilitas Utama -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                    <?php foreach($utama as $f):
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
                                <a href="/admin/facilities/<?= $f['id'] ?>/edit" class="w-8 h-8 rounded border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors"><i class="fa-solid fa-pencil text-[12px]"></i></a>
                                <a href="/admin/facilities/<?= $f['id'] ?>/delete"
                                   onclick="return konfirmasiHapus('<?= $f['nama'] ?>')"
                                   class="w-8 h-8 rounded border border-gray-100 flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-500 transition-colors"><i class="fa-regular fa-trash-can text-[12px]"></i></a>
                            </div>
                            <span class="text-[11px] font-medium text-gray-400 italic">Utama</span>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Fasilitas Pendukung -->
                <div class="mb-6"><h2 class="text-[22px] font-bold text-brand-textDark leading-tight">Fasilitas Lainnya</h2></div>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 md:gap-5 mb-14">
                    <?php foreach($pendukung as $p):
                        $p_img = !empty($p['gambar']) ? $p['gambar'] : 'https://images.unsplash.com/photo-1542816417-0983c9c9ad53?w=300&q=60';
                    ?>
                    <div class="bg-white rounded-xl overflow-hidden border border-gray-100 shadow-sm flex flex-col group relative">
                        <div class="h-[110px] w-full relative overflow-hidden bg-gray-100">
                            <img src="<?= $p_img ?>" class="absolute inset-0 w-full h-full object-cover">
                            <a href="/admin/facilities/<?= $p['id'] ?>/delete"
                               onclick="return konfirmasiHapus('<?= $p['nama'] ?>')"
                               class="absolute top-2 right-2 w-7 h-7 bg-black/40 backdrop-blur-sm rounded-md flex items-center justify-center text-white hover:bg-red-500 transition-colors opacity-0 group-hover:opacity-100">
                                <i class="fa-regular fa-trash-can text-[11px]"></i>
                            </a>
                        </div>
                        <div class="p-4 pt-3 flex flex-col flex-1">
                            <h4 class="font-bold text-[14px] text-brand-textDark leading-tight mb-0.5"><?= $p['nama'] ?></h4>
                            <p class="text-[10px] text-gray-400 line-clamp-1 mb-3"><?= !empty($p['deskripsi']) ? $p['deskripsi'] : 'Layanan pendukung' ?></p>
                            <a href="/admin/facilities/<?= $p['id'] ?>/edit" class="mt-auto w-7 h-7 rounded border border-gray-200 flex items-center justify-center text-gray-400 hover:bg-gray-50 hover:text-brand-orange transition-colors">
                                <i class="fa-solid fa-pencil text-[10px]"></i>
                            </a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Form Input -->
                <div id="app" class="grid grid-cols-1 lg:grid-cols-3 gap-6 pb-20">
                    <div class="lg:col-span-2 bg-white rounded-2xl p-8 border border-gray-100 shadow-sm">
                        <div class="mb-8">
                            <h3 class="text-[22px] font-bold text-brand-textDark mb-1">Input Fasilitas Baru</h3>
                            <p class="text-[13px] text-gray-500">Lengkapi data untuk publikasi di halaman pengunjung</p>
                        </div>

                        <form @submit.prevent="submitForm" enctype="multipart/form-data" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Nama Fasilitas</label>
                                    <input type="text" v-model="form.nama" placeholder="Contoh: Kolam Arus Anak" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all" required>
                                </div>
                                <div>
                                    <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Kategori</label>
                                    <select v-model="form.kategori" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all cursor-pointer">
                                        <option value="utama">Utama</option>
                                        <option value="pendukung">Pendukung</option>
                                    </select>
                                </div>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Deskripsi Fasilitas</label>
                                <textarea v-model="form.deskripsi" placeholder="Jelaskan keunggulan dan detail fasilitas ini..." class="w-full min-h-[120px] bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange resize-none transition-all"></textarea>
                            </div>
                            <div>
                                <label class="block text-[12px] font-bold text-gray-700 mb-2 tracking-wide uppercase">Upload Gambar</label>
                                <input type="file" @change="handleFileChange" accept="image/*" class="w-full bg-[#F8F9FA] border border-gray-200 text-gray-800 text-[14px] rounded-lg py-3 px-4 outline-none focus:ring-1 focus:ring-brand-orange transition-all">
                            </div>

                            <div class="flex justify-end items-center gap-6 pt-6">
                                <button type="button" @click="resetForm" class="text-[14px] font-bold text-gray-400 hover:text-gray-600 transition-colors">Batal</button>
                                <button type="submit" :disabled="loading" class="bg-[#C6714A] hover:bg-[#b0623f] disabled:bg-gray-400 text-white font-bold px-10 py-3 rounded-xl transition-all shadow-md active:scale-95">
                                    {{ loading ? 'Menyimpan...' : 'Simpan Fasilitas' }}
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Info Panel -->
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-sm h-fit">
                        <h4 class="text-[16px] font-bold text-brand-textDark mb-4">Panduan Input</h4>
                        <div class="space-y-4 text-[13px] text-gray-600">
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-lightbulb text-brand-orange mt-0.5"></i>
                                <p><strong>Fasilitas Utama:</strong> Kolam renang, area bermain, dll. Ditampilkan lebih menonjol.</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-info-circle text-blue-500 mt-0.5"></i>
                                <p><strong>Fasilitas Pendukung:</strong> Toilet, mushola, parkir, dll. Ditampilkan dalam grid kecil.</p>
                            </div>
                            <div class="flex items-start gap-3">
                                <i class="fa-solid fa-image text-green-500 mt-0.5"></i>
                                <p><strong>Gambar:</strong> Upload gambar berkualitas tinggi untuk tampilan yang menarik.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        const { createApp } = Vue;

        createApp({
            data() {
                return {
                    form: {
                        nama: '',
                        kategori: 'utama',
                        deskripsi: '',
                        gambar: null
                    },
                    loading: false
                }
            },
            methods: {
                handleFileChange(event) {
                    this.form.gambar = event.target.files[0];
                },
                async submitForm() {
                    if (!this.form.nama.trim()) {
                        alert('Nama fasilitas harus diisi!');
                        return;
                    }

                    this.loading = true;

                    const formData = new FormData();
                    formData.append('nama', this.form.nama);
                    formData.append('kategori', this.form.kategori);
                    formData.append('deskripsi', this.form.deskripsi);
                    if (this.form.gambar) {
                        formData.append('gambar', this.form.gambar);
                    }

                    try {
                        const response = await fetch('/admin/facilities', {
                            method: 'POST',
                            body: formData
                        });

                        const data = await response.json();

                        if (response.ok && data.success) {
                            alert('✅ Fasilitas berhasil ditambahkan!');
                            this.resetForm();
                            // Reload page to show new facility
                            location.reload();
                        } else if (!response.ok || !data.success) {
                            // Handle validation errors
                            let errorMsg = data.error || 'Gagal menambahkan fasilitas';
                            if (data.errors && typeof data.errors === 'object') {
                                errorMsg = Object.values(data.errors).join('\n');
                            }
                            console.error('Server error:', data);
                            alert('❌ Error:\\n' + errorMsg);
                        }
                    } catch (error) {
                        console.error('Fetch error:', error);
                        alert('❌ Terjadi kesalahan koneksi. Cek console untuk detail.');
                    } finally {
                        this.loading = false;
                    }
                },
                resetForm() {
                    this.form = {
                        nama: '',
                        kategori: 'utama',
                        deskripsi: '',
                        gambar: null
                    };
                    // Reset file input
                    const fileInput = document.querySelector('input[type="file"]');
                    if (fileInput) fileInput.value = '';
                }
            }
        }).mount('#app');
    </script>
</body>
</html>