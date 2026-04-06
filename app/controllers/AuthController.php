<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Services\AuthService;
use App\Models\User;
use App\Core\Session;

class AuthController extends Controller {
    protected $authService;
    protected $userModel;

    public function __construct(AuthService $authService, User $userModel) {
        $this->authService = $authService;
        $this->userModel = $userModel;
    }

    public function showLogin() {
        if ($this->authService->isAuthenticated()) {
            $this->redirect('/dashboard');
        }
        $this->render('auth/login', [], 'auth');
    }

    public function processLogin() {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $result = $this->authService->login($username, $password);

        if ($result['success']) {
            $this->redirect('/dashboard');
        } else {
            Session::start();
            $this->render('auth/login', [
                'error' => $result['error'],
                'remaining_attempts' => $_SESSION['login_attempts'] ?? 0
            ], 'auth');
        }
    }

    public function logout() {
        $this->authService->logout();
        $this->redirect('/');
    }

    public function showProfile() {
        if (!$this->authService->isAuthenticated()) {
            $this->redirect('/login');
        }

        Session::start();
        $user = $this->userModel->find($_SESSION['user_id']);
        $this->render('admin/users/profile', ['user' => $user], 'admin');
    }

    public function updateProfile() {
        Session::start();
        $userId = $_SESSION['user_id'];
        $currentPassword = $_POST['current_password'] ?? '';
        $newPassword = $_POST['new_password'] ?? '';

        $user = $this->userModel->find($userId);

        // Verify current password
        if (!$this->userModel->verifyPassword($currentPassword, $user['password'])) {
            $this->json(['success' => false, 'error' => 'Current password is incorrect'], 401);
        }

        // Update password
        $this->userModel->updatePassword($userId, $newPassword);
        $this->json(['success' => true, 'message' => 'Password updated successfully']);
    }
}