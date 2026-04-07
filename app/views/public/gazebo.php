<?php
require 'koneksi.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
date_default_timezone_set('Asia/Makassar');
$hari_ini = date('Y-m-d');

// 1. Ambil tanggal yang dipilih pengunjung (default: hari ini)
$tanggal_dipilih = isset($_GET['tanggal_kunjungan']) ? $_GET['tanggal_kunjungan'] : $hari_ini;

// 2. Ambil semua gazebo_id yang sudah terisi pada tanggal tersebut
$query_booked = mysqli_query($koneksi, "
    SELECT g.nomor_gazebo 
    FROM bookings b 
    JOIN gazebos g ON b.gazebo_id = g.id 
    WHERE b.tanggal_kunjungan = '$tanggal_dipilih' AND b.status = 'terisi'
");

$booked_gazebos = [];
while($row = mysqli_fetch_assoc($query_booked)) {
    $booked_gazebos[] = $row['nomor_gazebo'];
}

// Fungsi bantu untuk warna status
function getGazeboStatus($nomor, $booked_list) {
    if (in_array($nomor, $booked_list)) {
        // TERISI / BOOKING (ORANYE)
        return [
            'class' => 'bg-[#FFF8F5] border-[#FDEAE2] text-[#C2511D] cursor-not-allowed opacity-80 shadow-inner',
            'label' => 'Full',
            'onclick' => 'return false;',
            'is_booked' => true
        ];
    } else {
        // TERSEDIA (HIJAU MUDA)
        return [
            'class' => 'bg-[#DCFCE7] border-[#86EFAC] text-[#166534] cursor-pointer hover:-translate-y-1 hover:shadow-md transition-all',
            'label' => 'Kosong',
            'onclick' => 'pilihGazebo(this)',
            'is_booked' => false
        ];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ketersediaan Gazebo - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style> body { font-family: 'Poppins', sans-serif; } .no-scrollbar::-webkit-scrollbar { display: none; } </style>
</head>
<body class="bg-[#FAFAFB] text-gray-800 flex flex-col min-h-screen">

    <?php include 'includes/navbar.php'; ?>

    <main class="max-w-[1200px] mx-auto px-6 md:px-12 py-12 w-full flex-grow">
        
        <div class="mb-10 flex flex-col md:flex-row md:justify-between md:items-end gap-4">
            <div>
                <h1 class="text-[32px] font-bold text-[#1a1a24] mb-2">Ketersediaan Gazebo</h1>
                <p class="text-gray-500 text-[15px]">Cek status ketersediaan gazebo secara real-time.</p>
            </div>
            
            <div class="flex items-center gap-5 bg-white px-5 py-3 rounded-2xl border border-gray-100 shadow-sm">
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#10B981]"></div>
                    <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Tersedia</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-3 h-3 rounded-full bg-[#E88D57]"></div>
                    <span class="text-[11px] font-bold text-gray-500 uppercase tracking-wider">Terisi / Booking</span>
                </div>
            </div>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full lg:w-[320px] shrink-0 flex flex-col gap-6">
                
                <div class="bg-white p-6 rounded-[20px] shadow-sm border border-gray-100">
                    <h3 class="font-bold text-[#1a1a24] mb-4 flex items-center gap-2">
                        <i class="fa-regular fa-calendar text-[#E88D57]"></i> Waktu Kunjungan
                    </h3>
                    
                    <form action="" method="GET">
                        <div class="mb-5">
                            <label class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Pilih Tanggal</label>
                            <input type="date" name="tanggal_kunjungan" min="<?= $hari_ini ?>" value="<?= $tanggal_dipilih ?>" 
                                   onchange="this.form.submit()"
                                   class="w-full py-2.5 px-4 border border-gray-200 text-[14px] text-gray-700 rounded-lg outline-none focus:ring-2 focus:ring-[#E88D57]/30">
                        </div>
                    </form>

                    <label class="block text-[11px] font-semibold text-gray-400 uppercase tracking-wider mb-2">Durasi Sewa</label>
                    <div class="flex bg-gray-100 rounded-lg p-1">
                        <button id="btn-kurang-4" onclick="setDurasi('kurang')" class="flex-1 bg-white shadow-sm text-[#1a1a24] font-bold text-[13px] py-2 rounded-md transition-all">< 4 Jam</button>
                        <button id="btn-lebih-4" onclick="setDurasi('lebih')" class="flex-1 text-gray-500 font-medium text-[13px] py-2 rounded-md hover:bg-gray-200 transition-all">> 4 Jam</button>
                    </div>
                </div>

                <div class="bg-[#2B2B43] p-6 rounded-[20px] shadow-lg text-white">
                    <div class="flex justify-between items-start mb-6 border-b border-white/10 pb-5">
                        <div>
                            <span class="text-[#E88D57] text-[11px] font-bold uppercase tracking-wider">Gazebo Terpilih</span>
                            <h3 id="display-nomor" class="text-[24px] font-bold mt-1">Pilih Gazebo</h3>
                        </div>
                        <i class="fa-solid fa-tent text-[#E88D57] text-[24px]"></i>
                    </div>

                    <div class="flex justify-between text-[14px] mb-3"><span class="text-gray-400">Kapasitas</span><span id="display-kapasitas" class="font-medium">- Orang</span></div>
                    <div class="flex justify-between text-[14px] mb-6 border-b border-white/10 pb-5"><span class="text-gray-400">Total Harga</span><span id="display-harga" class="font-bold text-[#E88D57] text-[16px]">Rp 0</span></div>

                    <div class="mb-6">
                        <label class="block text-[11px] font-bold text-[#E88D57] uppercase tracking-wider mb-3">Pilih Admin Untuk Pemesanan</label>
                        <div class="space-y-3">
                            <label class="flex items-center gap-3 p-3 rounded-lg border border-[#E88D57]/30 bg-white/5 cursor-pointer hover:bg-white/10 transition-colors">
                                <input type="radio" name="admin" value="6285705996170" checked onchange="updateWaLink()" class="accent-[#E88D57] w-4 h-4">
                                <span class="text-[14px] font-medium">Admin Anggi</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg border border-white/10 hover:border-white/30 cursor-pointer hover:bg-white/5 transition-colors">
                                <input type="radio" name="admin" value="6285245372606" onchange="updateWaLink()" class="accent-[#E88D57] w-4 h-4">
                                <span class="text-[14px] font-medium text-gray-300">Admin Irwan</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-lg border border-white/10 hover:border-white/30 cursor-pointer hover:bg-white/5 transition-colors">
                                <input type="radio" name="admin" value="628125814350" onchange="updateWaLink()" class="accent-[#E88D57] w-4 h-4">
                                <span class="text-[14px] font-medium text-gray-300">Manajer</span>
                            </label>
                        </div>
                    </div>

                    <a href="#" id="wa-link" target="_blank" class="w-full bg-[#E88D57] hover:bg-[#D97C45] text-white font-bold py-4 rounded-xl flex items-center justify-center gap-2 transition-all shadow-md opacity-50 pointer-events-none">
                        <i class="fa-solid fa-message"></i> Pesan Sekarang
                    </a>
                </div>
            </div>

            <div class="w-full bg-white rounded-[30px] p-8 md:p-10 shadow-sm border border-gray-100 flex-grow">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-12 gap-y-10">
                    
                    <div class="lg:col-span-3">
                        <div class="border-l-[4px] border-[#22C55E] pl-3 mb-6"><h3 class="font-bold text-[#1a1a24] text-[15px]">Big Zone (30 Orang)</h3></div>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-4">
                            <?php $status = getGazeboStatus('G21', $booked_gazebos); ?>
                            <div onclick="<?= $status['onclick'] ?>" data-nomor="G21" data-kapasitas="30" data-hkurang="300000" data-hlebih="500000" 
                                 class="gazebo-item aspect-square border-2 rounded-2xl flex flex-col items-center justify-center font-bold text-[16px] <?= $status['class'] ?>">
                                G21
                                <?php if($status['is_booked']): ?> <span class="text-[8px] font-bold uppercase tracking-tighter mt-1">Full</span> <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="col-span-1 border-r border-gray-100 pr-8">
                        <div class="border-l-[4px] border-[#E88D57] pl-3 mb-6"><h3 class="font-bold text-[#1a1a24] text-[15px]">Family Zone (12 Orang)</h3></div>
                        <div class="grid grid-cols-3 gap-4">
                            <?php 
                            $family_zone = ['01','02','03','04','05','06'];
                            foreach($family_zone as $g): 
                                $status = getGazeboStatus($g, $booked_gazebos);
                            ?>
                            <div onclick="<?= $status['onclick'] ?>" data-nomor="<?= $g ?>" data-kapasitas="12" data-hkurang="100000" data-hlebih="200000" 
                                 class="gazebo-item aspect-square border-2 rounded-2xl flex flex-col items-center justify-center font-bold text-[16px] <?= $status['class'] ?>">
                                <?= $g ?>
                                <?php if($status['is_booked']): ?> <span class="text-[8px] font-bold uppercase tracking-tighter mt-1">Full</span> <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <div class="border-l-[4px] border-[#FBBF24] pl-3 mb-6"><h3 class="font-bold text-[#1a1a24] text-[15px]">Standard Zone (9 Orang)</h3></div>
                        <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 gap-4">
                            <?php 
                            $std_zone = ['07','08','09','10','11','12','13','14','15','16','17','18','19','20'];
                            foreach($std_zone as $g): 
                                $status = getGazeboStatus($g, $booked_gazebos);
                            ?>
                            <div onclick="<?= $status['onclick'] ?>" data-nomor="<?= $g ?>" data-kapasitas="9" data-hkurang="75000" data-hlebih="150000" 
                                 class="gazebo-item aspect-square border-2 rounded-2xl flex flex-col items-center justify-center font-bold text-[16px] <?= $status['class'] ?>">
                                <?= $g ?>
                                <?php if($status['is_booked']): ?> <span class="text-[8px] font-bold uppercase tracking-tighter mt-1">Full</span> <?php endif; ?>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </main>

    <section class="max-w-[1100px] mx-auto px-6 py-12 mb-10 border-t border-gray-200 mt-12">
        <div class="text-center mb-10">
            <h2 class="text-[22px] font-bold text-[#1a1a24] mb-3">Informasi Penyewaan Pendopo & Lapangan</h2>
            <p class="text-gray-500 text-[14px]">Hubungi admin kami untuk informasi penyewaan area luas lainnya:</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <a href="https://wa.me/6285705996170" target="_blank" class="bg-white border border-gray-100 rounded-[20px] p-6 flex items-center justify-between hover:shadow-lg transition-all group">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-[#FFF4ED] flex items-center justify-center text-[#E88D57]"><i class="fa-regular fa-user"></i></div>
                    <div><h4 class="font-bold text-[14px] text-[#1a1a24]">Admin Anggi</h4><p class="text-gray-400 text-[12px]">0857 0599 6170</p></div>
                </div>
                <i class="fa-brands fa-whatsapp text-[#10B981] text-[24px]"></i>
            </a>
            <a href="https://wa.me/6285245372606" target="_blank" class="bg-white border border-gray-100 rounded-[20px] p-6 flex items-center justify-between hover:shadow-lg transition-all group">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-[#FFF4ED] flex items-center justify-center text-[#E88D57]"><i class="fa-regular fa-user"></i></div>
                    <div><h4 class="font-bold text-[14px] text-[#1a1a24]">Admin Irwan</h4><p class="text-gray-400 text-[12px]">0852 4537 2606</p></div>
                </div>
                <i class="fa-brands fa-whatsapp text-[#10B981] text-[24px]"></i>
            </a>
            <a href="https://wa.me/628125814350" target="_blank" class="bg-white border border-gray-100 rounded-[20px] p-6 flex items-center justify-between hover:shadow-lg transition-all group">
                <div class="flex items-center gap-4">
                    <div class="w-11 h-11 rounded-full bg-[#FFF4ED] flex items-center justify-center text-[#E88D57]"><i class="fa-solid fa-headset"></i></div>
                    <div><h4 class="font-bold text-[14px] text-[#1a1a24]">Manajer</h4><p class="text-gray-400 text-[12px]">0812 5814 350</p></div>
                </div>
                <i class="fa-brands fa-whatsapp text-[#10B981] text-[24px]"></i>
            </a>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
        let durasiDipilih = 'kurang';
        let gazeboDipilih = null;

        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', minimumFractionDigits: 0 }).format(angka);
        }

        function setDurasi(tipe) {
            durasiDipilih = tipe;
            const btnKurang = document.getElementById('btn-kurang-4');
            const btnLebih = document.getElementById('btn-lebih-4');

            if (tipe === 'kurang') {
                btnKurang.className = "flex-1 bg-white shadow-sm text-[#1a1a24] font-bold text-[13px] py-2 rounded-md transition-all";
                btnLebih.className = "flex-1 text-gray-500 font-medium text-[13px] py-2 rounded-md hover:bg-gray-200 transition-all";
            } else {
                btnLebih.className = "flex-1 bg-white shadow-sm text-[#1a1a24] font-bold text-[13px] py-2 rounded-md transition-all";
                btnKurang.className = "flex-1 text-gray-500 font-medium text-[13px] py-2 rounded-md hover:bg-gray-200 transition-all";
            }
            if(gazeboDipilih) { updateDetail(gazeboDipilih); }
        }

        function pilihGazebo(element) {
            document.querySelectorAll('.gazebo-item:not(.cursor-not-allowed)').forEach(g => {
                g.className = "gazebo-item aspect-square bg-[#DCFCE7] border-2 border-[#86EFAC] rounded-2xl flex flex-col items-center justify-center text-[#166534] font-bold text-[16px] cursor-pointer hover:-translate-y-1 transition-all";
            });
            element.className = "gazebo-item aspect-square bg-[#E88D57] border-2 border-[#D97C45] rounded-2xl flex flex-col items-center justify-center text-white font-bold text-[16px] shadow-lg ring-2 ring-[#E88D57]/30 ring-offset-2 transition-all scale-105";
            gazeboDipilih = element;
            updateDetail(element);
        }

        function updateDetail(element) {
            let nomor = element.getAttribute('data-nomor');
            let kapasitas = element.getAttribute('data-kapasitas');
            let harga = (durasiDipilih === 'kurang') ? element.getAttribute('data-hkurang') : element.getAttribute('data-hlebih');
            document.getElementById('display-nomor').innerText = "Gazebo #" + nomor;
            document.getElementById('display-kapasitas').innerText = kapasitas + " Orang";
            document.getElementById('display-harga').innerText = formatRupiah(harga);
            updateWaLink();
        }

        function updateWaLink() {
            if(!gazeboDipilih) return;
            const waBtn = document.getElementById('wa-link');
            const admin = document.querySelector('input[name="admin"]:checked').value;
            const tgl = "<?= $tanggal_dipilih ?>";
            const msg = `Halo Admin, saya ingin memesan gazebo:\n\n*Gazebo:* #${gazeboDipilih.getAttribute('data-nomor')}\n*Tanggal:* ${tgl}\n*Durasi:* ${durasiDipilih === 'kurang' ? '< 4 Jam' : '> 4 Jam'}\n*Harga:* ${document.getElementById('display-harga').innerText}\n\nApakah masih tersedia?`;
            waBtn.href = `https://wa.me/${admin}?text=${encodeURIComponent(msg)}`;
            waBtn.classList.remove('opacity-50', 'pointer-events-none');
        }
    </script>
</body>
</html>