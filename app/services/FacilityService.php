<?php
namespace App\Services;

use App\Models\Facility;
use App\Services\ImageService;
use App\Core\Validator;

class FacilityService {
    protected $facilityModel;
    protected $imageService;
    protected $validator;

    public function __construct(Facility $facilityModel, ImageService $imageService, Validator $validator) {
        $this->facilityModel = $facilityModel;
        $this->imageService = $imageService;
        $this->validator = $validator;
    }

    public function create(array $data, $imageFile = null) {
        // Validate input
        $rules = [
            'nama' => 'required|min:3|max:100',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ];

        if (!$this->validator->validate($data, $rules)) {
            return ['success' => false, 'errors' => $this->validator->getErrors()];
        }

        // Create facility
        $id = $this->facilityModel->create($data);

        // Handle image if provided
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->imageService->upload($imageFile, 'facilities');
            // Store image reference (in dokumentasi table)
        }

        return ['success' => true, 'id' => $id];
    }

    public function update($id, array $data, $imageFile = null) {
        // Validate
        $rules = [
            'nama' => 'required|min:3|max:100',
            'kategori' => 'required',
            'deskripsi' => 'required'
        ];

        if (!$this->validator->validate($data, $rules)) {
            return ['success' => false, 'errors' => $this->validator->getErrors()];
        }

        $this->facilityModel->update($id, $data);

        // Handle image replacement
        if ($imageFile && $imageFile['error'] === UPLOAD_ERR_OK) {
            // Delete old image
            // Upload new image
            $imagePath = $this->imageService->upload($imageFile, 'facilities');
        }

        return ['success' => true];
    }

    public function delete($id) {
        // Delete associated images first
        $this->imageService->deleteByFacilityId($id);

        // Then delete facility
        return $this->facilityModel->delete($id);
    }

    public function getByCategory($category) {
        return $this->facilityModel->getByCategory($category);
    }

    public function getById($id) {
        return $this->facilityModel->find($id);
    }
}