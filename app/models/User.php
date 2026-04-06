<?php
namespace App\Models;

use App\Core\Model;

class User extends Model {
    protected $table = 'users';
    protected $fillable = ['username', 'password'];

    public function findByUsername($username) {
        $results = $this->where('username', $username);
        return $results[0] ?? null;
    }

    public function create(array $data) {
        // Hash password before creating
        if (isset($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        }
        return parent::create($data);
    }

    public function verifyPassword($password, $hash) {
        return password_verify($password, $hash);
    }

    public function updatePassword($userId, $newPassword) {
        return $this->update($userId, [
            'password' => password_hash($newPassword, PASSWORD_BCRYPT)
        ]);
    }
}