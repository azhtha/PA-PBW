<?php
namespace App\Services;

class ImageService {
    protected $uploadDir = 'public/uploads/facilities';
    protected $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    protected $maxFileSize = 5 * 1024 * 1024; // 5MB

    public function upload($file, $category = 'default') {
        // Validate file
        if (!$this->isValidFile($file)) {
            return ['success' => false, 'error' => 'Invalid file'];
        }

        // Create filename
        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $filename = time() . '_' . uniqid() . '.' . $extension;
        $uploadPath = $this->uploadDir . '/' . $category . '/';

        // Create directory if not exists
        if (!is_dir($uploadPath)) {
            mkdir($uploadPath, 0755, true);
        }

        // Move file
        $destination = $uploadPath . $filename;
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return ['success' => true, 'path' => $destination, 'filename' => $filename];
        }

        return ['success' => false, 'error' => 'Upload failed'];
    }

    protected function isValidFile($file) {
        if ($file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if ($file['size'] > $this->maxFileSize) {
            return false;
        }

        $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        return in_array($extension, $this->allowedExtensions);
    }

    public function delete($path) {
        if (file_exists($path)) {
            return unlink($path);
        }
        return false;
    }

    public function deleteByFacilityId($facilityId) {
        // Implementation to delete images associated with facility
        // This would query the dokumentasi table
    }
}