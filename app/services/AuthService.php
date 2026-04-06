<?php
namespace App\Services;

use App\Models\User;
use App\Core\Session;

class AuthService {
    protected $userModel;
    protected $maxAttempts = 3;
    protected $lockoutTime = 300; // 5 minutes

    public function __construct(User $userModel) {
        $this->userModel = $userModel;
    }

    public function login($username, $password) {
        // Check if account is locked
        if ($this->isLocked()) {
            return ['success' => false, 'error' => 'Account temporarily locked'];
        }

        $user = $this->userModel->findByUsername($username);

        if (!$user || !$this->userModel->verifyPassword($password, $user['password'])) {
            $this->recordFailedAttempt();
            return ['success' => false, 'error' => 'Invalid credentials'];
        }

        // Reset failed attempts
        Session::remove('login_attempts');
        Session::remove('last_attempt_time');

        // Create session
        Session::set('login', true);
        Session::set('user_id', $user['id']);
        Session::set('username', $user['username']);

        return ['success' => true];
    }

    public function logout() {
        Session::destroy();
    }

    public function isAuthenticated() {
        return Session::has('login') && Session::has('user_id');
    }

    protected function recordFailedAttempt() {
        $attempts = Session::get('login_attempts', 0) + 1;
        Session::set('login_attempts', $attempts);
        Session::set('last_attempt_time', time());
    }

    protected function isLocked() {
        if (!Session::has('login_attempts') || Session::get('login_attempts') < $this->maxAttempts) {
            return false;
        }

        $timePassed = time() - Session::get('last_attempt_time', 0);
        return $timePassed < $this->lockoutTime;
    }

    public function getRemainingLockoutTime() {
        $timePassed = time() - Session::get('last_attempt_time', 0);
        return ceil(($this->lockoutTime - $timePassed) / 60);
    }
}