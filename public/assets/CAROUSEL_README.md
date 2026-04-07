# Carousel Tentang Kami - Dokumentasi

## Deskripsi

Implementasi slide carousel untuk halaman "Tentang Kami" (tentang.php) menggunakan Swiper.js, Tailwind CSS, dan Font Awesome icons.

## File yang Dibuat/Diubah

### 1. **public/tentang.php** (Baru)

Halaman utama "Tentang Kami" dengan fitur-fitur berikut:

- Hero section dengan judul dan deskripsi
- Section "Selamat Datang" dengan informasi tentang taman
- **Galeri Foto dengan Carousel**:
  - Swiper Slider dengan animasi fade
  - 5 gambar dari assets
  - Navigation arrows (prev/next buttons)
  - Pagination dots
  - Image counter
  - Thumbnail navigation di bawah carousel
  - Auto-play dengan delay 5 detik
- Statistics section dengan pencapaian
- Call-to-action section

### 2. **public/assets/carousel.css** (Baru)

File CSS khusus untuk styling carousel:

- Custom styling untuk Swiper pagination
- Navigation button styles
- Thumbnail hover effects
- Responsive adjustments untuk mobile
- Fade effect animations

### 3. **includes/navbar.php** (Diubah)

Penambahan link "Tentang Kami" di navigasi utama

- Link mengarah ke `tentang.php`
- Active state highlighting sesuai halaman saat ini

## Fitur Carousel

### 1. **Auto-play**

- Carousel otomatis berpindah setiap 5 detik
- Dapat dihentikan dengan interaksi pengguna

### 2. **Navigation**

- **Previous/Next Buttons**: Tombol navigasi di kedua sisi carousel
  - Hover effect dengan scale animation
  - Icon chevron (dari Font Awesome)
- **Pagination Dots**: Bulatan di bawah carousel untuk indikasi slide
  - Clickable untuk navigasi langsung
  - Animated transitions

### 3. **Thumbnail Navigation**

- 5 thumbnail gambar di bawah carousel
- Klik thumbnail untuk navigate langsung ke slide tersebut
- Hover effect dengan zoom
- Descriptions untuk setiap thumbnail

### 4. **Image Counter**

- Menampilkan slide saat ini (misal: "1 / 5")
- Update otomatis saat slide berubah
- Positioned di bottom-left carousel

### 5. **Responsive Design**

- Mobile: Tinggi carousel 300px
- Desktop: Tinggi carousel 500px
- Navigation buttons adaptive size
- Thumbnail grid responsive (5 kolom di desktop, 1 kolom di mobile)

## Gambar yang Digunakan

Carousel menggunakan 5 gambar dari folder `public/assets/`:

1. `hero.png` - Pemandangan Umum
2. `Card1.png` - Area Bermain
3. `Card2.png` - Fasilitas
4. `InformasiUmum-Pengunjung.png` - Informasi Pengunjung
5. `map_bg.png` - Lokasi Taman

## Instalasi Dependencies

Dependencies sudah menggunakan CDN, tidak perlu instalasi tambahan:

- **Swiper JS**: https://cdn.jsdelivr.net/npm/swiper@11/
- **Tailwind CSS**: https://cdn.tailwindcss.com
- **Font Awesome**: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css

## Cara Menggunakan

### Mengakses Halaman Tentang Kami

```
http://localhost/PA-PBW/public/tentang.php
```

### Menambah Slide Baru

1. Tambahkan gambar ke folder `public/assets/`
2. Edit `tentang.php`:
   - Tambahkan `<div class="swiper-slide">` baru di dalam `.swiper-wrapper`
   - Tambahkan thumbnail di section "Image Descriptions"
3. Update nomor total di image counter (ubah `/5` menjadi jumlah yang tepat)

### Mengubah Delay Auto-play

Di file `tentang.php`, bagian JavaScript, ubah nilai `delay`:

```javascript
autoplay: {
    delay: 5000, // Ubah nilai ini (dalam milliseconds), 5000 = 5 detik
    disableOnInteraction: false,
}
```

### Mengubah Warna/Style

Carousel menggunakan Tailwind utility classes:

- Warna utama: `#E88D57` (orange)
- Warna background: `#2B2B43` (dark blue)
- Ubah class-class di HTML untuk styling custom

## Browser Support

- Chrome/Edge: ✓ Full support
- Firefox: ✓ Full support
- Safari: ✓ Full support
- IE 11: ✗ Not supported (Swiper 11 memerlukan modern browser)

## Tips Performa

1. Optimize gambar sebelum mengupload (compress PNG/JPG)
2. Lazy loading dapat ditambahkan jika ada banyak slides
3. Gunakan WebP format untuk kompatibilitas modern browser

## Troubleshooting

### Carousel tidak muncul

- Pastikan gambar ada di `public/assets/`
- Check browser console untuk error JavaScript
- Pastikan Swiper CDN dapat diakses

### Navigation tidak bekerja

- Hapus cache browser (Ctrl+Shift+Del)
- Refresh halaman
- Check console untuk error

### Responsive tidak bekerja

- Pastikan Tailwind CSS CDN aktif
- Mobile viewport meta tag sudah ada di `<head>`

## Future Enhancements

- Tambahkan keyboard navigation (arrow keys)
- Implement touch gestures untuk mobile
- Tambahkan lightbox untuk full-screen view
- Add filter untuk kategori foto
- Implement infinite loop dengan smooth transitions

---

**Created**: 2026-04-07
**Framework**: Tailwind CSS + Swiper.js
**Responsive**: ✓ Mobile, Tablet, Desktop
