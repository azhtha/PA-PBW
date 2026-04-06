<?php
namespace App\Models;

use App\Core\Model;

class Facility extends Model {
    protected $table = 'fasilitas';
    protected $fillable = ['nama', 'kategori', 'deskripsi'];

    public function getWithImage($id) {
        $sql = "SELECT f.*,
                (SELECT gambar FROM dokumentasi d WHERE d.fasilitas_id = f.id LIMIT 1) AS gambar
                FROM {$this->table} f
                WHERE f.id = ?";
        return $this->db->query($sql, [$id])->first();
    }

    public function getByCategory($category) {
        $sql = "SELECT f.*,
                (SELECT gambar FROM dokumentasi d WHERE d.fasilitas_id = f.id LIMIT 1) AS gambar
                FROM {$this->table} f
                WHERE f.kategori = ?
                ORDER BY f.nama ASC";
        return $this->db->query($sql, [$category])->get();
    }

    public function getAllWithImages() {
        $sql = "SELECT f.*,
                (SELECT gambar FROM dokumentasi d WHERE d.fasilitas_id = f.id LIMIT 1) AS gambar
                FROM {$this->table} f
                ORDER BY f.kategori, f.nama";
        return $this->db->query($sql)->get();
    }
}