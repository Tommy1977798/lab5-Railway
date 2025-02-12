<?php
namespace App\Models;

use App\Core\Database;
use PDO;

class UserModel {
    public function createUser($username, $password) {
        $db = Database::getConnection();
        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, $password]);
    }

    public function getUserByUsername($username) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserById($userId) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateUsername($userId, $newUsername) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users SET username = ? WHERE id = ?");
        return $stmt->execute([$newUsername, $userId]);
    }

    public function updatePassword($userId, $newPassword) {
        $db = Database::getConnection();
        $stmt = $db->prepare("UPDATE users SET password = ? WHERE id = ?");
        return $stmt->execute([$newPassword, $userId]);
    }
}
