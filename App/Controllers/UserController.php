<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Core\Database;

class UserController {
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

            $userModel = new UserModel();
            $userModel->createUser($username, $password);
            header("Location: /login");
        }
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $user = $userModel->getUserByUsername($username);

            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                header("Location: /");
            } else {
                echo "登录失败，请检查用户名和密码";
            }
        }
    }

    public function viewProfile() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']);

        if (!$user) {
            session_destroy();
            header("Location: /login");
            exit();
        }


        include __DIR__ . '/../Views/profile.php';
    }

    public function updateProfile() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit();
        }

        $userId = $_SESSION['user_id'];
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if ($username) {
            $userModel = new UserModel();
            $userModel->updateUsername($userId, $username);
            $_SESSION['username'] = $username;
        }

        if ($password) {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $userModel->updatePassword($userId, $hashedPassword);
            $_SESSION['flash_message'] = "密码更新成功！";
        }
        
        header("Location: /update-profile");
        exit();
    }
}
