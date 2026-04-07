<?php
session_start();
require 'koneksi.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nomor_gazebo = $_POST['nomor_gazebo'];
    $tanggal_kunjungan = $_POST['tanggal_kunjungan'];
    $action = $_POST['action']; 

    $query_gz = mysqli_query($koneksi, "SELECT id FROM gazebos WHERE nomor_gazebo = '$nomor_gazebo'");
    
    if(mysqli_num_rows($query_gz) > 0) {
        $gazebo = mysqli_fetch_assoc($query_gz);
        $gazebo_id = $gazebo['id'];

        // KONDISI 1: HAPUS/CHECKOUT
        if ($action == 'delete') {
            $query_hapus = "DELETE FROM bookings WHERE gazebo_id = '$gazebo_id' AND tanggal_kunjungan = '$tanggal_kunjungan'";
            mysqli_query($koneksi, $query_hapus);
        } 
        // KONDISI 2: SIMPAN
        else if ($action == 'save') {
            $nama_pemesan = mysqli_real_escape_string($koneksi, $_POST['nama_pemesan']);
            $no_whatsapp = mysqli_real_escape_string($koneksi, $_POST['no_whatsapp']);
            $durasi = mysqli_real_escape_string($koneksi, $_POST['durasi']);
            
            // Tangkap jam (jika kosong, ubah jadi NULL agar database tidak error)
            $jam_mulai = !empty($_POST['jam_mulai']) ? "'" . mysqli_real_escape_string($koneksi, $_POST['jam_mulai']) . "'" : "NULL";
            $jam_selesai = !empty($_POST['jam_selesai']) ? "'" . mysqli_real_escape_string($koneksi, $_POST['jam_selesai']) . "'" : "NULL";

            $cek_booking = mysqli_query($koneksi, "SELECT id FROM bookings WHERE gazebo_id = '$gazebo_id' AND tanggal_kunjungan = '$tanggal_kunjungan'");

            if(mysqli_num_rows($cek_booking) > 0) {
                $booking = mysqli_fetch_assoc($cek_booking);
                $booking_id = $booking['id'];
                
                $query_update = "UPDATE bookings SET 
                                 nama_pemesan = '$nama_pemesan', 
                                 no_whatsapp = '$no_whatsapp', 
                                 durasi = '$durasi',
                                 jam_mulai = $jam_mulai,
                                 jam_selesai = $jam_selesai,
                                 status = 'terisi'
                                 WHERE id = '$booking_id'";
                mysqli_query($koneksi, $query_update) or die(mysqli_error($koneksi));
            } else {
                $query_insert = "INSERT INTO bookings (gazebo_id, tanggal_kunjungan, nama_pemesan, no_whatsapp, durasi, jam_mulai, jam_selesai, status) 
                                 VALUES ('$gazebo_id', '$tanggal_kunjungan', '$nama_pemesan', '$no_whatsapp', '$durasi', $jam_mulai, $jam_selesai, 'terisi')";
                mysqli_query($koneksi, $query_insert) or die(mysqli_error($koneksi));
            }
        }
        header("Location: status_gazebo.php?tanggal=" . $tanggal_kunjungan);
        exit;
    }
}
?>