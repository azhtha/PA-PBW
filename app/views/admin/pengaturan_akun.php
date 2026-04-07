<?php
session_start();
// Pastikan koneksi.php sudah benar
require 'koneksi.php';

$message = "";
$status = "";

// Mengambil ID dari session login (Faris, pastikan saat login ID ini disimpan di session)
// Jika belum ada session, kita ambil user pertama sebagai contoh testing
if (!isset($_SESSION['user_id'])) {
    $res_first = mysqli_query($koneksi, "SELECT id FROM users LIMIT 1");
    $first_user = mysqli_fetch_assoc($res_first);
    $user_id = $first_user['id'];
} else {
    $user_id = $_SESSION['user_id'];
}

// --- LOGIKA 1: UPDATE PROFIL SENDIRI ---
if (isset($_POST['update_profile'])) {
    $username_baru = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password_lama = $_POST['password_lama'];
    $password_baru = $_POST['password_baru'];

    // Ambil data password lama dari DB untuk verifikasi
    $query_cek = mysqli_query($koneksi, "SELECT password FROM users WHERE id = '$user_id'");
    $data_user = mysqli_fetch_assoc($query_cek);

    // Verifikasi password lama (Menggunakan password_verify karena di gambar DB kamu terlihat pakai Hash)
    if (password_verify($password_lama, $data_user['password'])) {
        $sql = "UPDATE users SET username = '$username_baru'";
        
        if (!empty($password_baru)) {
            $pass_hash = password_hash($password_baru, PASSWORD_DEFAULT);
            $sql .= ", password = '$pass_hash'";
        }
        $sql .= " WHERE id = '$user_id'";
        
        if (mysqli_query($koneksi, $sql)) {
            $message = "Username/Password berhasil diubah!";
            $status = "success";
        }
    } else {
        $message = "Password verifikasi salah!";
        $status = "error";
    }
}

// --- LOGIKA 2: TAMBAH ADMIN BARU (UUID) ---
if (isset($_POST['register_admin'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username_reg']);
    $password = mysqli_real_escape_string($koneksi, $_POST['password_reg']);

    $cek = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $message = "Username sudah terdaftar!";
        $status = "error";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        // Menggunakan UUID() sesuai struktur DB kamu
        $query = "INSERT INTO users (id, username, password) VALUES (UUID(), '$username', '$password_hash')";
        
        if (mysqli_query($koneksi, $query)) {
            $message = "Admin baru berhasil ditambahkan!";
            $status = "success";
        } else {
            $message = "Gagal menambah admin!";
            $status = "error";
        }
    }
}

// Ambil data username untuk ditampilkan di UI
$res_profil = mysqli_query($koneksi, "SELECT username FROM users WHERE id = '$user_id'");
$curr_user = mysqli_fetch_assoc($res_profil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Otoritas - Taman Salma Shofa</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Poppins', 'sans-serif'] },
                    colors: {
                        brand: { orange: '#e88d57', dark: '#1A1A24', input: '#2B2B3A', textDark: '#1A1A24' }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-[#f5f6f8] min-h-screen flex flex-col justify-center items-center p-4">

    <a href="dashboard_admin.php" class="fixed top-6 left-6 z-50 bg-white shadow-sm border border-gray-100 px-5 py-2.5 rounded-full text-brand-textDark font-bold text-xs flex items-center gap-2 hover:bg-brand-orange hover:text-white transition-all group">
        <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
        KEMBALI KE DASHBOARD
    </a>

    <main class="w-full max-w-[900px] bg-white rounded-[40px] shadow-[0_30px_80px_-20px_rgba(0,0,0,0.1)] flex flex-col md:flex-row overflow-hidden min-h-[600px]">
        
        <div class="w-full md:w-2/5 bg-gradient-to-b from-white to-gray-50 p-10 flex flex-col justify-between items-center text-center relative border-r border-gray-100">
            <div class="absolute w-64 h-64 bg-brand-orange/5 rounded-full blur-3xl -top-10 -left-10"></div>
            
            <div class="relative z-10">
                <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?auto=format&fit=crop&w=400&q=80" class="w-20 h-20 object-cover rounded-3xl shadow-lg mx-auto mb-6">
                <h1 class="text-xl font-extrabold text-brand-textDark leading-tight tracking-tight">MANAJEMEN<br><span class="text-brand-orange">AKUN ADMIN</span></h1>
                <p class="text-gray-400 text-[10px] uppercase tracking-[2px] mt-4 font-bold">Salma Shofa Portal</p>
            </div>

            <?php if ($message): ?>
            <div class="w-full p-4 rounded-2xl border <?= $status == 'success' ? 'bg-green-50 border-green-200 text-green-600' : 'bg-red-50 border-red-200 text-red-600' ?> relative z-10">
                <p class="text-[10px] font-bold uppercase"><?= $message ?></p>
            </div>
            <?php endif; ?>

            <div class="flex items-center gap-3 relative z-10 bg-brand-dark/5 p-3 rounded-2xl w-full">
                <img src="https://ui-avatars.com/api/?name=<?= $curr_user['username'] ?>&background=E88D57&color=fff" class="w-8 h-8 rounded-lg">
                <div class="text-left">
                    <p class="text-[11px] font-bold text-brand-textDark leading-none"><?= $curr_user['username'] ?></p>
                    <p class="text-[9px] text-gray-400 font-bold uppercase mt-1">Logged In</p>
                </div>
            </div>
        </div>

        <div class="w-full md:w-3/5 bg-brand-dark p-10 lg:p-12 overflow-y-auto no-scrollbar">
            
            <div class="mb-10">
                <h2 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-brand-orange rounded-full"></span> Ubah Akun Saya
                </h2>

                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-[9px] font-bold uppercase mb-2 ml-1 tracking-widest">Username</label>
                        <input type="text" name="username" value="<?= $curr_user['username'] ?>" required class="w-full bg-brand-input text-white text-sm rounded-xl py-3.5 px-4 outline-none border border-transparent focus:border-brand-orange transition-all">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-gray-500 text-[9px] font-bold uppercase mb-2 ml-1 tracking-widest">Sandi Verifikasi</label>
                            <input type="password" name="password_lama" placeholder="Sandi Lama" required class="w-full bg-brand-input text-white text-sm rounded-xl py-3.5 px-4 outline-none border border-transparent focus:border-brand-orange transition-all">
                        </div>
                        <div>
                            <label class="block text-gray-500 text-[9px] font-bold uppercase mb-2 ml-1 tracking-widest">Sandi Baru</label>
                            <input type="password" name="password_baru" placeholder="Opsional" class="w-full bg-brand-input text-white text-sm rounded-xl py-3.5 px-4 outline-none border border-transparent focus:border-brand-orange transition-all">
                        </div>
                    </div>
                    <button type="submit" name="update_profile" class="w-full bg-brand-orange text-brand-dark font-bold text-[11px] py-4 rounded-xl uppercase tracking-widest hover:opacity-90 transition-all mt-2">
                        Simpan Perubahan
                    </button>
                </form>
            </div>

            <div class="border-t border-gray-800 my-10 border-dashed"></div>

            <div>
                <h2 class="text-white font-bold text-lg mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-6 bg-white/20 rounded-full"></span> Tambah Admin
                </h2>

                <form action="" method="POST" class="space-y-4">
                    <div>
                        <label class="block text-gray-500 text-[9px] font-bold uppercase mb-2 ml-1 tracking-widest">Username Baru</label>
                        <input type="text" name="username_reg" placeholder="admin_baru" required class="w-full bg-brand-input text-white text-sm rounded-xl py-3.5 px-4 outline-none border border-transparent focus:border-white/20 transition-all">
                    </div>
                    <div>
                        <label class="block text-gray-500 text-[9px] font-bold uppercase mb-2 ml-1 tracking-widest">Kata Sandi</label>
                        <input type="password" name="password_reg" placeholder="••••••••" required class="w-full bg-brand-input text-white text-sm rounded-xl py-3.5 px-4 outline-none border border-transparent focus:border-white/20 transition-all">
                    </div>
                    <button type="submit" name="register_admin" class="w-full bg-white/10 text-white font-bold text-[11px] py-4 rounded-xl uppercase tracking-widest hover:bg-white hover:text-brand-dark transition-all mt-2">
                        Daftarkan Admin Baru
                    </button>
                </form>
            </div>

        </div>
    </main>

    <p class="mt-8 text-[10px] text-gray-400 font-bold uppercase tracking-[4px]">Salmashofa Security System</p>

</body>
</html>