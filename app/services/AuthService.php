<?php
namespace App\Services;

use App\Models\User;
use App\Core\Session;
use App\Core\Logger;

class AuthService {
    protected $userModel;
    protected $logger;
    protected $maxAttempts = 3;
    protected $lockoutTime = 300; // 5 minutes

    public function __construct(User $userModel, Logger $logger = null) {
        $this->userModel = $userModel;
        $this->logger = $logger ?: new Logger();
    }

    public function login($username, $password) {
        // Check if account is locked
        if ($this->isLocked()) {
            return [
                'success' => false,
                'error' => 'Account temporarily locked',
                'debug' => [
                    'reason' => 'lockout_active',
                    'max_attempts' => $this->maxAttempts,
                    'lockout_time_seconds' => $this->lockoutTime
                ]
            ];
        }

        $user = $this->userModel->findByUsername($username);

        if (!$user || !$this->userModel->verifyPassword($password, $user['password'])) {
            $ip = $_SERVER['REMOTE_ADDR'] ?? 'unknown';
            $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'unknown';
            $this->logger->warning("Failed login attempt - Username: {$username}, IP: {$ip}, User-Agent: {$userAgent}");
            $this->recordFailedAttempt();
            return [
                'success' => false,
                'error' => 'Invalid credentials',
                'debug' => [
                    'reason' => 'invalid_credentials',
                    'username' => $username
                ]
            ];
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

}