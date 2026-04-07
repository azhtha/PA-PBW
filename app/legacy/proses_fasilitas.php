<?php
// 1. AKTIFKAN ERROR REPORTING (Sangat Penting untuk Debugging)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
require 'koneksi.php';

// Cek apakah folder 'image_tss' sudah ada, jika belum buat otomatis
if (!is_dir('image_tss')) {
    mkdir('image_tss', 0777, true);
}

// --- LOGIKA 1: UPDATE DATA (EDIT) ---
if (isset($_POST['update'])) {
    $id = mysqli_real_escape_string($koneksi, $_POST['id']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $sql = "UPDATE fasilitas SET nama = '$nama', kategori = '$kategori', deskripsi = '$deskripsi' WHERE id = '$id'";
    
    if (mysqli_query($koneksi, $sql)) {
        if (!empty($_FILES['gambar']['name'])) {
            $nama_file = time() . "_" . $_FILES['gambar']['name'];
            $folder = "image_tss/" . $nama_file;

            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $folder)) {
                $cek_img = mysqli_query($koneksi, "SELECT id FROM dokumentasi WHERE fasilitas_id = '$id'");
                if (mysqli_num_rows($cek_img) > 0) {
                    mysqli_query($koneksi, "UPDATE dokumentasi SET gambar = '$folder' WHERE fasilitas_id = '$id'");
                } else {
                    mysqli_query($koneksi, "INSERT INTO dokumentasi (id, fasilitas_id, gambar) VALUES (UUID(), '$id', '$folder')");
                }
            }
        }
        header("Location: kelola_fasilitas.php?msg=updated");
        exit;
    } else {
        die("Error Update: " . mysqli_error($koneksi));
    }
}

// --- LOGIKA 2: TAMBAH DATA BARU (SIMPAN) ---
if (isset($_POST['simpan'])) {
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);

    $query_f = "INSERT INTO fasilitas (id, nama, kategori, deskripsi) VALUES (UUID(), '$nama', '$kategori', '$deskripsi')";
    
    if (mysqli_query($koneksi, $query_f)) {
        // Ambil ID yang baru saja dibuat oleh UUID()
        $res_id = mysqli_query($koneksi, "SELECT id FROM fasilitas WHERE nama = '$nama' ORDER BY id DESC LIMIT 1");
        $row = mysqli_fetch_assoc($res_id);
        $fasilitas_id = $row['id'];

        if (!empty($_FILES['gambar']['name'])) {
            $folder = "image_tss/" . time() . "_" . $_FILES['gambar']['name'];
            if (move_uploaded_file($_FILES['gambar']['tmp_name'], $folder)) {
                mysqli_query($koneksi, "INSERT INTO dokumentasi (id, fasilitas_id, gambar) VALUES (UUID(), '$fasilitas_id', '$folder')");
            }
        }
        header("Location: kelola_fasilitas.php?msg=success");
        exit;
    } else {
        die("Error Simpan: " . mysqli_error($koneksi));
    }
}

// --- LOGIKA 3: HAPUS DATA ---
if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Ambil info gambar untuk dihapus dari folder (opsional tapi bagus untuk hemat storage)
    $res_img = mysqli_query($koneksi, "SELECT gambar FROM dokumentasi WHERE fasilitas_id = '$id'");
    $data_img = mysqli_fetch_assoc($res_img);
    if ($data_img && file_exists($data_img['gambar'])) {
        unlink($data_img['gambar']);
    }

    mysqli_query($koneksi, "DELETE FROM dokumentasi WHERE fasilitas_id = '$id'");
    if (mysqli_query($koneksi, "DELETE FROM fasilitas WHERE id = '$id'")) {
        header("Location: kelola_fasilitas.php?msg=deleted");
        exit;
    } else {
        die("Error Hapus: " . mysqli_error($koneksi));
    }
}

// Jika tidak ada kondisi yang terpenuhi, balikkan ke halaman utama
header("Location: kelola_fasilitas.php");
exit;