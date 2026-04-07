<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taman Salma Shofa</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script src="assets/js/tailwind-config.js"></script>
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- ✅ VUE -->
    <script src="https://unpkg.com/vue@3"></script>

    <style>
        body { font-family: 'Poppins', sans-serif; }
    </style>
</head>

<body class="text-gray-800 antialiased bg-[#FAFAFB] flex flex-col min-h-screen">

<?php include 'includes/navbar.php'; ?>

<!-- ✅ VUE ROOT -->
<div id="app">

    <!-- HERO -->
    <section class="w-full h-[200px] md:h-[280px] lg:h-[320px] overflow-hidden bg-gray-100">
        <img src="assets/hero.png" 
             alt="Suasana Taman Salma Shofa" 
             class="w-full h-full object-cover object-center">
    </section>

    <!-- JUDUL -->
    <section class="max-w-4xl mx-auto px-6 pt-16 pb-12 text-center">
        <h1 class="text-[32px] md:text-[48px] font-semibold text-[#1a1a24] mb-4 tracking-tight">
            {{ title }}
        </h1>
        <p class="text-gray-500 text-[14px] md:text-[15px]">
            Jika bukan karena kasih sayang, bisakah kamu besar seperti sekarang?
        </p>

        <!-- INTERAKSI -->
        <button @click="ubahText"
            class="mt-6 bg-[#E88D57] text-white px-5 py-2 rounded-lg shadow">
            Klik Aku
        </button>
    </section>

    <!-- CARD -->
    <section class="max-w-6xl mx-auto px-6 md:px-8 pb-20">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8">
            
            <div class="relative overflow-hidden h-[220px] md:h-[240px] shadow-lg group bg-gray-200 rounded-[20px]">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700" 
                     style="background-image: url('assets/Card1.png');"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#E88D57] via-[#E88D57]/90 to-transparent"></div>
                
                <div class="relative z-10 p-8 h-full flex flex-col justify-center w-[85%] md:w-[80%]">
                    <h3 class="text-white text-[24px] md:text-[28px] font-bold mb-2">Info Lengkap Wisata</h3>
                    <p class="text-white/90 text-[13px] mb-6">Temukan info lengkap tentang Taman Salma Shofa</p>
                    <a href="informasi.php" class="border border-white text-white px-6 py-2">Selengkapnya</a>
                </div>
            </div>

            <div class="relative overflow-hidden h-[220px] md:h-[240px] shadow-lg group bg-gray-200 rounded-[20px]">
                <div class="absolute inset-0 bg-cover bg-center group-hover:scale-105 transition-transform duration-700" 
                     style="background-image: url('assets/Card2.png');"></div>
                <div class="absolute inset-0 bg-gradient-to-r from-[#E88D57] via-[#E88D57]/90 to-transparent"></div>
                
                <div class="relative z-10 p-8 h-full flex flex-col justify-center w-[85%] md:w-[80%]">
                    <h3 class="text-white text-[24px] md:text-[28px] font-bold mb-2">Cek Ketersediaan Gazebo</h3>
                    <p class="text-white/90 text-[13px] mb-6">Lihat ketersediaan gazebo secara real-time</p>
                    <a href="gazebo.php" class="border border-white text-white px-6 py-2">Cek Sekarang</a>
                </div>
            </div>

        </div>
    </section>

    <!-- TESTIMONI -->
    <section class="bg-[#FAFAFB] py-20 border-t border-gray-200">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-14">
                <span class="text-[#E88D57] text-[11px] font-bold uppercase">Testimoni</span>
                <h2 class="text-3xl font-bold mt-2">Ulasan Pengunjung</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                <!-- LOOP -->
                <div v-for="item in testimoni"
                     class="bg-white p-8 rounded-[20px] shadow-sm border">

                    <p class="text-gray-500 text-[13px] mb-6 italic">
                        "{{ item.text }}"
                    </p>

                    <div class="flex items-center gap-3">
                        <img :src="item.img" class="w-10 h-10 rounded-full">
                        <span class="font-bold text-[13px]">
                            {{ item.nama }}
                        </span>
                    </div>

                </div>

            </div>
        </div>
    </section>

</div>

<?php include 'includes/footer.php'; ?>

<!-- SCRIPT VUE -->
<script>
Vue.createApp({
    data() {
        return {
            title: "Selamat Datang di Taman Salma Shofa 🌿",

            testimoni: [
                {
                    nama: "Dewi Minhajuhayati",
                    text: "Disini banyak spot foto yang instagram-able.",
                    img: "https://i.pravatar.cc/150?img=47"
                },
                {
                    nama: "Frimita Sadi",
                    text: "Tempatnya bersih dan nyaman.",
                    img: "https://i.pravatar.cc/150?img=11"
                },
                {
                    nama: "Yusup Marwan",
                    text: "Cocok untuk keluarga.",
                    img: "https://i.pravatar.cc/150?img=68"
                }
            ]
        }
    },

    methods: {
        ubahText() {
            this.title = "Selamat menikmati wisata 🎉"
        }
    }

}).mount('#app')
</script>

</body>
</html>