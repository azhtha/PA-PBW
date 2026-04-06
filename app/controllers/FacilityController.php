<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\FacilityService;
use App\Services\AuthService;
use App\Models\User;

class FacilityController extends Controller {
    protected $facilityService;
    protected $authService;

    public function __construct(FacilityService $facilityService, AuthService $authService) {
        $this->facilityService = $facilityService;
        $this->authService = $authService;
    }

    public function index() {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        $facilities = $this->facilityService->getAll();
        $utama = array_filter($facilities, fn($f) => $f['kategori'] === 'utama');
        $pendukung = array_filter($facilities, fn($f) => $f['kategori'] === 'pendukung');

        $this->render('admin/facilities/index', [
            'utama' => $utama,
            'pendukung' => $pendukung
        ], 'admin');
    }

    public function create() {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        $this->render('admin/facilities/form', [], 'admin');
    }

    public function store() {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        $data = [
            'nama' => $_POST['nama'] ?? '',
            'kategori' => $_POST['kategori'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? ''
        ];

        $imageFile = $_FILES['gambar'] ?? null;

        $result = $this->facilityService->create($data, $imageFile);

        if ($result['success']) {
            $this->redirect('/admin/facilities');
        } else {
            $this->render('admin/facilities/form', [
                'errors' => $result['errors'],
                'old' => $data
            ], 'admin');
        }
    }

    public function edit($id) {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        $facility = $this->facilityService->getById($id);
        if (!$facility) {
            $this->redirect('/admin/facilities');
        }

        $this->render('admin/facilities/edit', ['facility' => $facility], 'admin');
    }

    public function update($id) {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        $data = [
            'nama' => $_POST['nama'] ?? '',
            'kategori' => $_POST['kategori'] ?? '',
            'deskripsi' => $_POST['deskripsi'] ?? ''
        ];

        $imageFile = $_FILES['gambar'] ?? null;

        $result = $this->facilityService->update($id, $data, $imageFile);

        if ($result['success']) {
            $this->redirect('/admin/facilities');
        } else {
            $facility = $this->facilityService->getById($id);
            $this->render('admin/facilities/edit', [
                'facility' => $facility,
                'errors' => $result['errors'],
                'old' => $data
            ], 'admin');
        }
    }

    public function delete($id) {
        if (!$this->authService->isAuthenticated()) {
            $this->json(['success' => false, 'error' => 'Unauthorized'], 401);
        }

        $result = $this->facilityService->delete($id);
        $this->json(['success' => $result]);
    }
}