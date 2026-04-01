<?php
session_start();
require 'koneksi.php';

// Jika sudah login, redirect
if (isset($_SESSION['login'])) {
    header('Location: dashboard_admin.php');
    exit;
}

$success = false;
$error = false;
$error_msg = "";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];

    // Cek apakah username sudah ada
    $cek = mysqli_query($koneksi, "SELECT username FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        $error = true;
        $error_msg = "Username sudah terdaftar!";
    } else {
        // Enkripsi password
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        
        // Simpan ke database dengan MySQL UUID()
        $query = "INSERT INTO users (id, username, password) VALUES (UUID(), '$username', '$password_hash')";
        
        if (mysqli_query($koneksi, $query)) {
            $success = true;
        } else {
            $error = true;
            $error_msg = "Registrasi gagal!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Admin Portal - Taman Salma Shofa</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Google Fonts: Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="font-sans antialiased bg-[#f5f6f8] min-h-screen flex flex-col justify-center items-center p-4 sm:p-6">

    <!-- Main Card Container -->
    <main class="w-full max-w-[950px] bg-white rounded-2xl shadow-[0_20px_50px_-12px_rgba(0,0,0,0.15)] flex flex-col md:flex-row overflow-hidden min-h-[580px]">
        
        <!-- Left Panel (Illustration & Branding) -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-white to-gray-50 p-10 lg:p-14 flex flex-col justify-center items-center text-center relative">
            <!-- Decorative soft glow behind the image (optional touch) -->
            <div class="absolute w-64 h-64 bg-brand-orange/5 rounded-full blur-3xl -top-10 -left-10"></div>
            
            <!-- Image -->
            <img src="https://images.unsplash.com/photo-1542273917363-3b1817f69a2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                 alt="Taman Salma Shofa Pemandangan" 
                 class="w-[280px] h-[190px] object-cover rounded-xl shadow-md mb-8 relative z-10">
            
            <!-- Branding Text -->
            <h1 class="text-3xl font-bold text-brand-textDark leading-tight mb-4 relative z-10">
                Taman Salma<br>Shofa
            </h1>
            <p class="text-gray-500 text-sm leading-relaxed max-w-xs relative z-10">
                Gerbang menuju pengelolaan keindahan dan kenyamanan rekreasi keluarga di Kalimantan Timur.
            </p>
        </div>

        <!-- Right Panel (Register Form) -->
        <div class="w-full md:w-1/2 bg-brand-dark p-10 lg:p-14 flex flex-col justify-center relative">
            
            <div class="mb-8">
                <h2 class="text-2xl font-semibold text-white mb-2">Daftar Admin Baru</h2>
                <p class="text-gray-400 text-sm">Silakan buat akun untuk mengelola sistem.</p>
            </div>

            <form action="" method="POST" class="space-y-5">
                <?php if($error) : ?>
                    <p class="text-red-500 text-xs font-semibold"><?php echo $error_msg; ?></p>
                <?php endif; ?>
                
                <?php if($success) : ?>
                    <div class="bg-green-500/10 border border-green-500 rounded-lg p-3">
                        <p class="text-green-500 text-xs font-semibold">Registrasi berhasil! Silakan <a href="login.php" class="underline hover:text-green-400">Login disini</a>.</p>
                    </div>
                <?php endif; ?>

                <!-- Username / Email Input -->
                <div>
                    <label class="block text-gray-300 text-xs font-semibold mb-2">Username atau Email</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-regular fa-user text-gray-400 text-sm"></i>
                        </div>
                        <input type="text" name="username" placeholder="Masukkan username" required
                               class="w-full bg-brand-input text-white text-sm rounded-lg py-3.5 pl-11 pr-4 outline-none focus:ring-1 focus:ring-brand-orange placeholder-gray-500 transition-shadow">
                    </div>
                </div>

                <!-- Password Input -->
                <div>
                    <label class="block text-gray-300 text-xs font-semibold mb-2">Password</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i class="fa-solid fa-lock text-gray-400 text-sm"></i>
                        </div>
                        <input type="password" name="password" placeholder="........" required
                               class="w-full bg-brand-input text-white text-sm rounded-lg py-3.5 pl-11 pr-4 outline-none focus:ring-1 focus:ring-brand-orange placeholder-gray-500 transition-shadow">
                    </div>
                </div>

                <div class="flex items-center pt-1">
                    <p class="text-gray-400 text-xs text-center w-full">
                        Sudah punya akun? <a href="login.php" class="text-brand-orange font-semibold hover:text-orange-400 transition-colors">Masuk sekarang</a>
                    </p>
                </div>

                <!-- Submit Button -->
                <button type="submit" name="register" class="w-full bg-brand-orange hover:bg-[#e8985c] text-brand-textDark font-bold text-sm py-3.5 rounded-lg mt-4 transition-colors flex items-center justify-center gap-2 shadow-sm">
                    Daftar Sekarang
                    <i class="fa-solid fa-user-plus"></i>
                </button>
            </form>

            <!-- Bottom Indicator -->
            <div class="mt-14 pt-6 border-t border-gray-600/30">
                <div class="flex items-center text-brand-orange/90 text-xs font-bold tracking-wider">
                    <i class="fa-solid fa-shield-halved mr-2 text-sm"></i> ADMIN OTORITAS
                </div>
            </div>

        </div>

    </main>

    <!-- Footer Outside Card -->
    <footer class="mt-10 text-center space-y-4">
        <div class="flex justify-center items-center gap-4 text-xs font-medium text-gray-400">
            <a href="#" class="hover:text-gray-600 transition-colors border-b border-transparent hover:border-gray-400 pb-0.5">Bantuan</a>
            <a href="#" class="hover:text-gray-600 transition-colors border-b border-transparent hover:border-gray-400 pb-0.5">Privasi</a>
            <a href="#" class="hover:text-gray-600 transition-colors border-b border-transparent hover:border-gray-400 pb-0.5">Syarat & Ketentuan</a>
        </div>
        <p class="text-xs text-gray-500 font-medium">
            &copy; 2026 Taman Salma Shofa. Admin Portal.
        </p>
    </footer>

</body>
</html>
